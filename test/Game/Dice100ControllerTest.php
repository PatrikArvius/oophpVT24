<?php

namespace Parv\Dice100;

use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class Dice100ControllerTest extends TestCase
{
    private $controller;
    private $app;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new Dice100Controller();
        $this->controller->setApp($app);
        //$this->controller->initialize();
    }



    /**
     * Call the controller index action.
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller debug action.
     */
    public function testDebugAction()
    {
        $res = $this->controller->debugAction();
        $this->assertIsString($res);
        $this->assertContains("Test debug action route, debugging!", $res);
    }



    /**
     * Call the controller init action.
     */
    public function testInitAction()
    {
        $res = $this->controller->initAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller initProcess action.
     */
    public function testInitProcessActionPost()
    {
        $res = $this->controller->initProcessActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller play action.
     */
    public function testPlayAction()
    {
        $res = $this->controller->playAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /**
     * Call the controller playProcess action.
     */
    public function testPlayProcessActionPost()
    {
        $res = $this->controller->playProcessActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->app->request->setPost("newGame", "abba");

        $res = $this->controller->playProcessActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }



    /* *
     * Call the controller dump-app action GET.
     */
    /* public function testDumpAppActionGet()
    {
        $res = $this->controller->dumpAppActionGet();
        $this->assertIsString($res);
        $this->assertContains("app contains", $res);
    } */



    /**
     * Call the controller info action GET.
     */
    /* public function testInfoActionGet()
    {
        $res = $this->controller->infoActionGet();
        $this->assertIsString($res);
        $this->assertStringEndsWith("active", $res);
    } */



    /**
     * Call the controller create action GET.
     */
    /* public function testCreateActionGet()
    {
        $res = $this->controller->createActionGet();
        $this->assertIsString($res);
        $this->assertStringEndsWith("active", $res);
    } */



    /**
     * Call the controller create action POST.
     */
    /* public function testCreateActionPost()
    {
        $res = $this->controller->createActionPost();
        $this->assertIsString($res);
        $this->assertStringEndsWith("active", $res);
    } */



    /**
     * Call the controller argument/<value> action GET.
     */
    /* public function testArgumentActionGet()
    {
        $arg = "111";
        $res = $this->controller->argumentActionGet($arg);
        $this->assertIsString($res);
        $this->assertContains($arg, $res);

        $arg = "4242";
        $res = $this->controller->argumentActionGet($arg);
        $this->assertIsString($res);
        $this->assertContains($arg, $res);
    } */



    /**
     * Call the controller default-argument/<value> action GET.
     */
    /* public function testDefaultArgumentActionGet()
    {
        $res = $this->controller->defaultArgumentActionGet();
        $this->assertIsString($res);
        $this->assertContains("default", $res);

        $arg = "4242";
        $res = $this->controller->defaultArgumentActionGet($arg);
        $this->assertIsString($res);
        $this->assertContains($arg, $res);
    } */



    /**
     * Call the controller typed-argument/<str>/<int> action GET.
     */
    /* public function testTypedArgumentActionGet()
    {
        $str = "four-two";
        $int = 42;
        $res = $this->controller->typedArgumentActionGet($str, $int);
        $this->assertIsString($res);
        $this->assertContains($str, $res);
        $this->assertContains(strval($int), $res);
    } */



    /**
     * Call the controller variadic/* action GET.
     */
    /* public function testVariadicActionGet()
    {
        $str = "four-two";
        $int = 42;
        $res = $this->controller->variadicActionGet($str, $int);
        $this->assertIsString($res);
        $this->assertContains($str, $res);
        $this->assertContains(strval($int), $res);
        $this->assertContains("'2' arguments", $res);

        $res = $this->controller->variadicActionGet($str);
        $this->assertIsString($res);
        $this->assertContains($str, $res);
        $this->assertContains("'1' arguments", $res);

        $res = $this->controller->variadicActionGet();
        $this->assertIsString($res);
        $this->assertContains("'0' arguments", $res);
    } */



    /**
     * Call the controller catchAll ANY.
     */
    /* public function testCatchAllGet()
    {
        $res = $this->controller->catchAll();
        $this->assertNull($res);
    } */
}
