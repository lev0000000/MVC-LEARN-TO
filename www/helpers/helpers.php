<?php

/**
 * Summary of app
 * @return PHPFramework\Application|null
 */

function app(): \PHPFramework\Application
{
    return \PHPFramework\Application::$app; 
}

/**
 * Summary of request
 * @return PHPFramework\Request
 */

function request(): \PHPFramework\Request
{
    return app()->request;
}

/**
 * Summary of response
 * @return PHPFramework\Response
 */

function response(): \PHPFramework\Response
{
    return app()->response;
}

/**
 * Summary of session
 * @return PHPFramework\Session
 */
function session(): \PHPFramework\Session
{
    return app()->session;
}

/**
 * Summary of view
 * @param mixed $view
 * @param mixed $data
 * @param mixed $layout
 * @return PHPFramework\View|string
 */
function view($view = null,  $data = [], $layout = ''): string|\PHPFramework\View
{
    if ($view) {
        return app()->view->render($view, $data, $layout);
    } else {
        return app()->view;
    }
}

/**
 * Summary of db
 * @return PHPFramework\Database
 */
function db(){
    return app()->db;
}

/**
 * Summary of abort:
 * The handler error_page
 * @param mixed $error
 * @param mixed $code
 * @return never
 */

function abort($error = '', $code = 404)
{
    response()->setResponseCode($code);
    echo view('errors/' . $code, ['error' => $error], false);
    die();
}

/**
 * Summary of base_url:
 * For URL;
 * @param mixed $path
 * @return string
 */

function base_url($path = ''): string
{
    return PATH . $path;
}

/**
 * Summary of get_alerts
 * For alerts message from session key
 * Render partitial for alerts
 * @return void
 */

function get_alerts(): void
{
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $key => $value) {
            echo view()->renderPartial("incs/alert_{$key}", ["flash_{$key}" => session()->getFlash($key)]);
        }
    }
}

/**
 * Summary of get_errors
 * @param mixed $fieldname
 * @return string
 */

function get_errors($fieldname): string
{
    $output = '';
    $errors = session()->get('form_errors');

    if (isset($errors[$fieldname])) {
        $output = '<div style="color:red;">';
        foreach ($errors[$fieldname] as $error) {
            $output .= '<p>' . $error . '</p>';
        }
        $output .= '</div>';
    }

    return $output;
}

/**
 * Summary of old
 * @param mixed $fieldname
 * @return string
 */

function old($fieldname): string
{

    return isset(session()->get('form_data')[$fieldname]) ? h(session()->get('form_data')[$fieldname]) : '';
}

/**
 * Summary of h
 * @param mixed $str
 * @return string
 */

function h($str): string
{

    return htmlspecialchars($str, ENT_QUOTES);
}

/**
 * Summary of get_validation_class
 * @param mixed $fieldname
 * @return string
 */

function get_validation_class($fieldname)
{
    $errors = session()->get('form_errors');
    if (empty($errors)) {
        return '';
    }
    return isset($errors[$fieldname]) ? 'is-invalid' : 'is-valid';
}

/**
 * Summary of get_csrf_field
 * @return string
 */
function get_csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . session()->get('csrf_token') . '">';
}

/**
 * Summary of get_csrf_meta
 * @return string
 */
function get_csrf_meta()
{
    return '<meta name="csrf-token" content="' . session()->get('csrf_token') . '">';
}


/**
 * Summary of check_auth
 * @return bool
 */
function check_auth(){
    return false;
}
