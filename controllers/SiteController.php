<?php
/*
 * Este es el único controlador que usa el sistema de facturación
 * se encarga de realizar todas las acciones del sistema
 * sirviendo de puente entre los modelos y las vistas
 */

namespace app\controllers;

use app\models\Articulo;
use app\models\Ciudad;
use app\models\Cliente;
use app\models\DetalleFactura;
use app\models\Factura;
use app\models\LoginForm;
use app\models\Proveedor;
use app\models\TipoArticulo;
use app\searchs\ArticuloSearch;
use app\searchs\CiudadSearch;
use app\searchs\ClienteSearch;
use app\searchs\DetalleFacturaSearch;
use app\searchs\FacturaSearch;
use app\searchs\ProveedorSearch;
use app\searchs\TipoArticuloSearch;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use phpDocumentor\Reflection\Types\This;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'logout',
                    'tipo-Articulos',
                    'proveedor',
                    'ciudad',
                    'clientes',
                    'articulos',
                    'nuevo-ciudad',
                    'nuevo-tipo-Articulo',
                    'nuevo-proveedor',
                    'nuevo-articulo',
                    'nuevo-cliente',
                    'facturas',
                    'ver',
                    'venta-confirmada',
                    'eliminar',
                    'nuevo',
                    'venta-nueva',
                    'imprimir',
                ],
                'rules' => [
                    [
                        'actions' => [
                            'logout',
                            'tipo-Articulos',
                            'proveedor',
                            'ciudad',
                            'clientes',
                            'articulos',
                            'nuevo-ciudad',
                            'nuevo-tipo-Articulo',
                            'nuevo-proveedor',
                            'nuevo-articulo',
                            'nuevo-cliente',
                            'facturas',
                            'ver',
                            'venta-confirmada',
                            'eliminar',
                            'nuevo',
                            'venta-nueva',
                            'imprimir',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex()
    {
        /*
         * Esta es la acción principal, la cuál toma el MODELO de la FACTURA
         * y lo envía a la vista para crear el formulario
         * la condición del IF sirve para verificar si los datos enviados desde el formulario son correctos
         * si es así, se procede a tomarlos con variables POST e irlos guardando en las propiedades del modelo
         * luego de que todos las propiedades son SETEADAS, se guarda y si no ocurre algún error, esta acción
         * redirigirá a la siguiente acción 'venta-nueva'.
         */
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        } else {
            $model = new Factura();
            if ($model->load(Yii::$app->request->post())) {
                $factura = Factura::getNuevaFactura();
                $numero = (int)(substr($factura['Nnm_factura'], 5, 999)) + 1;
                $factura = 'FACT-' . $numero;
                $model->Nnm_factura = $factura;
                $model->cod_cliente = $_POST['Factura']['cod_cliente'];
                $model->Nombre_empleado = $_POST['Factura']['Nombre_empleado'];
                $model->Fecha_facturacion = date('Y-m-d');
                $model->cod_formapago = $_POST['Factura']['cod_formapago'];
                if ($model->save()) {
                    $this->redirect(['site/venta-nueva', 'factura' => $factura]);
                }
            }
            return $this->render('index', ['model' => $model]);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionVentaNueva()
    {
        /*
         * Esta acción toma la variable enviada por el método GET de la acción anterior
         * creando y modelando el DETALLE de la FACTURA relacionada a la factura creada
         * Los detalles de esta acción se ven reflejados en la vista VENTA-NUEVA
         */
        $factura = $_GET['factura'];
        $model = Factura::findById($factura);
        $searchModel = new DetalleFacturaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $factura);
        return $this->render('venta-nueva', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'factura' => $factura, 'model' => $model]);
    }

    public function actionNuevo()
    {
        /*
         * Esta acción va validando y registrando los productos en el DETALLE FACTURA
         * realizando el cálculo de la multiplicación de la cantidad por su precio unitario
         * y verificando que la cantidad ingresada no sea mayor al stock del artículo
         */
        $model = new DetalleFactura();
        if ($model->load(Yii::$app->request->post())) {
            $code = 0;
            $y = Articulo::findById($_POST['DetalleFactura']['cod_articulo']);
            $cantidad = $_POST['DetalleFactura']['cantidad'];
            if ($y['stock'] < $cantidad) {
                $cantidad = null;
                $code = 2;
            }
            $x = Articulo::findById($_POST['DetalleFactura']['cod_articulo']);
            $model->cod_factura = $_POST['DetalleFactura']['cod_factura'];
            $model->cod_articulo = $_POST['DetalleFactura']['cod_articulo'];
            $model->total = $model->cantidad * $x['precio_costo'];
            $model->cantidad = $cantidad;
            if ($model->save())
                return json_encode(['code' => 1]);
            else
                return json_encode(['code' => $code]);
        }
        return $this->renderAjax('_nuevo', ['model' => $model, 'factura' => $_GET['Factura']]);
    }

    public function actionEliminar()
    {
        /*
         * Aquí se busca el artículo de una factura en específico para eliminarla del detalle
         * esto solo ocurre en la factura que está siendo procesada, en facturas ya emitidas no se puede eliminar
         * afectaría a la contabilidad
         */
        try {
            $model = DetalleFactura::findByIdCod($_GET['id']);
            if ($model->delete())
                return json_encode(['code' => 1]);
            else
                return json_encode(['code' => 0]);
        } catch (StaleObjectException $e) {
            return json_encode(['code' => $e]);
        } catch (\Throwable $e) {
            return json_encode(['code' => $e]);
        }
    }

    public function actionVentaConfirmada()
    {
        /*
         * Esta acción de VENTA CONFIRMADA se accionará cuando el vendedor haga clic en el botón
         * CONFIRMAR VENTA, realizando el cálculo final del subtotal, del iva y del total
         * los mismo que serán guardados en la FACTURA
         */
        $factura = $_GET['factura'];
        $total = DetalleFactura::findSumById($factura);
        $detalles = DetalleFactura::findById($factura);
        foreach ($detalles as $value) {
            $articulo = Articulo::findById($value['cod_articulo']);
            $restar = $articulo->stock - $value['cantidad']; //Realiza la resta del stock del artículo con la cantidad que se está vendiendo
            $articulo->stock = $restar;
            $articulo->save();
        }
        Factura::updateAll(['total_factura' => $total * 1.12, 'IVA' => $total * 0.12], ['Nnm_factura' => $factura]);//Actualiza la información de la factura con su respectivo IVA y Total
        return $this->redirect(['site/facturas']);
    }

    public function actionFacturas()
    {
        /*
         * Una vez confirmada la factura, la misma se procederá a mostrar en un listado de facturas emitidas
         * este listado se mostrará en la vista FACTURAS mostrando la lista completa o el resultado de una búsqueda
         */
        $searchModel = new FacturaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('facturas', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionVer()
    {
        /*
         * Esta acción VER sirve para tomar un número de factura específico y mostrar todos sus detalles una vez emitida
         */
        $factura = $_GET['factura'];
        $model = Factura::findById($factura);
        $searchModel = new DetalleFacturaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $factura);
        return $this->render('ver', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'factura' => $factura, 'model' => $model]);
    }
    public function actionImprimir()
    {
        /*
         * Esta acción VER sirve para tomar un número de factura específico y mostrar todos sus detalles una vez emitida
         */
        $factura = $_GET['factura'];
        $model = Factura::findById($factura);
        $searchModel = new DetalleFacturaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $factura);
        try {
            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE,
                'filename' => $factura.'.pdf',
                'orientation' => Pdf::ORIENT_PORTRAIT,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('ver', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'factura' => $factura, 'model' => $model]),
                'options' => [],
                'methods' => []
            ]);
            return $pdf->render();
        } catch (MpdfException $e) {
            Yii::$app->session->setFlash('error', 'Hubo un error al descargar el PDF');
            return $this->redirect(['imprimir', 'factura' => $factura]);
        } catch (CrossReferenceException $e) {
            Yii::$app->session->setFlash('error', 'Hubo un error al descargar el PDF');
            return $this->redirect(['imprimir', 'factura' => $factura]);
        } catch (PdfTypeException $e) {
            Yii::$app->session->setFlash('error', 'Hubo un error al descargar el PDF');
            return $this->redirect(['imprimir', 'factura' => $factura]);
        } catch (PdfParserException $e) {
            Yii::$app->session->setFlash('error', 'Hubo un error al descargar el PDF');
            return $this->redirect(['imprimir', 'factura' => $factura]);
        } catch (InvalidConfigException $e) {
            Yii::$app->session->setFlash('error', 'Hubo un error al descargar el PDF');
            return $this->redirect(['imprimir', 'factura' => $factura]);
        }
    }

    public function actionNuevoCliente()
    {
        /*
         * Esta acción sirve para registrar un nuevo CLIENTE, desde un formulario en la vista _NUEVO-CLIENTE
         * tomando todos sus datos con el método POST y seteando el modelo para poder ser registrado
         */
        $model = new CLiente();
        if ($model->load(Yii::$app->request->post())) {
            $model->Documento = $_POST['Cliente']['Documento'];
            $model->cod_tipo_documento = $_POST['Cliente']['cod_tipo_documento'];
            $model->Nombres = $_POST['Cliente']['Nombres'];
            $model->Apellidos = $_POST['Cliente']['Apellidos'];
            $model->Direccion = $_POST['Cliente']['Direccion'];
            $model->cod_ciudad = $_POST['Cliente']['cod_ciudad'];
            $model->Telefono = $_POST['Cliente']['Telefono'];
            if ($model->save())
                return json_encode(['code' => 1]);
            else
                return json_encode(['code' => 0]);
        }
        return $this->renderAjax('_nuevo-cliente', ['model' => $model]);
    }

    public function actionNuevoArticulo()
    {
        /*
         * Esta acción sirve para registrar un nuevo ARTÍCULO, desde un formulario en la vista _NUEVO-ARTICULO
         * tomando todos sus datos con el método POST y seteando el modelo para poder ser registrado
         */
        $model = new Articulo();
        if ($model->load(Yii::$app->request->post())) {
            $model->descripcion = $_POST['Articulo']['descripcion'];
            $model->precio_venta = $_POST['Articulo']['precio_venta'];
            $model->precio_costo = $_POST['Articulo']['precio_costo'];
            $model->stock = $_POST['Articulo']['stock'];
            $model->cod_tipo_articulo = $_POST['Articulo']['cod_tipo_articulo'];
            $model->cod_proveedor = $_POST['Articulo']['cod_proveedor'];
            $model->fecha_ingreso = date('Y-m-d');
            if ($model->save())
                return json_encode(['code' => 1]);
            else
                return json_encode(['code' => 0]);
        }
        return $this->renderAjax('_nuevo-articulo', ['model' => $model]);
    }

    public function actionNuevoProveedor()
    {
        /*
         * Esta acción sirve para registrar un nuevo PROVEEDOR, desde un formulario en la vista _NUEVO-PROVEEDOR
         * tomando todos sus datos con el método POST y seteando el modelo para poder ser registrado
         */
        $model = new Proveedor();
        if ($model->load(Yii::$app->request->post())) {
            $model->No_documento = $_POST['Proveedor']['No_documento'];
            $model->cod_tipo_documento = $_POST['Proveedor']['cod_tipo_documento'];
            $model->Nombre = $_POST['Proveedor']['Nombre'];
            $model->Apellido = $_POST['Proveedor']['Apellido'];
            $model->direccion = $_POST['Proveedor']['direccion'];
            $model->Nombre_comercial = $_POST['Proveedor']['Nombre_comercial'];
            $model->cod_ciudad = $_POST['Proveedor']['cod_ciudad'];
            $model->Telefono = $_POST['Proveedor']['Telefono'];
            if ($model->save())
                return json_encode(['code' => 1]);
            else
                return json_encode(['code' => 0]);
        }
        return $this->renderAjax('_nuevo-proveedor', ['model' => $model]);
    }

    public function actionNuevoTipoArticulo()
    {
        /*
         * Esta acción sirve para registrar un nuevo TIPO de ARTICULO, desde un formulario en la vista _NUEVO-TIPO-ARTICULO
         * tomando todos sus datos con el método POST y seteando el modelo para poder ser registrado
         */
        $model = new TipoArticulo();
        if ($model->load(Yii::$app->request->post())) {
            $model->descripcion_articulo = $_POST['TipoArticulo']['descripcion_articulo'];
            if ($model->save())
                return json_encode(['code' => 1]);
            else
                return json_encode(['code' => 0]);
        }
        return $this->renderAjax('_nuevo-tipo-articulo', ['model' => $model]);
    }

    public function actionNuevoCiudad()
    {
        /*
         * Esta acción sirve para registrar una nueva CIUDAD, desde un formulario en la vista _NUEVO-CIUDAD
         * tomando todos sus datos con el método POST y seteando el modelo para poder ser registrado
         */
        $model = new Ciudad();
        if ($model->load(Yii::$app->request->post())) {
            $model->Nombre_ciudad = $_POST['Ciudad']['Nombre_ciudad'];
            if ($model->save())
                return json_encode(['code' => 1]);
            else
                return json_encode(['code' => 0]);
        }
        return $this->renderAjax('_nuevo-ciudad', ['model' => $model]);
    }

    public function actionArticulos()
    {
        /*
         * Este tipo de función con el modelo SEARCH sirver para mostrar el listado completo de un modelo
         * en WIDGET y para poder realizar búsquedas dentro del mismo, mostrando los resultados de forma
         * inmediata
         */
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('articulos', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionClientes()
    {
        /*
         * Este tipo de función con el modelo SEARCH sirver para mostrar el listado completo de un modelo
         * en WIDGET y para poder realizar búsquedas dentro del mismo, mostrando los resultados de forma
         * inmediata
         */
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('clientes', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionCiudad()
    {
        /*
         * Este tipo de función con el modelo SEARCH sirver para mostrar el listado completo de un modelo
         * en WIDGET y para poder realizar búsquedas dentro del mismo, mostrando los resultados de forma
         * inmediata
         */
        $searchModel = new CiudadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('ciudades', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionProveedor()
    {
        /*
         * Este tipo de función con el modelo SEARCH sirver para mostrar el listado completo de un modelo
         * en WIDGET y para poder realizar búsquedas dentro del mismo, mostrando los resultados de forma
         * inmediata
         */
        $searchModel = new ProveedorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('proveedores', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionTipoArticulos()
    {
        /*
         * Este tipo de función con el modelo SEARCH sirver para mostrar el listado completo de un modelo
         * en WIDGET y para poder realizar búsquedas dentro del mismo, mostrando los resultados de forma
         * inmediata
         */
        $searchModel = new TipoArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('tipo-articulos', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }
}
