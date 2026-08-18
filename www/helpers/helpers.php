<?php

function app(): \PHPFramework\Application
{
    return \PHPFramework\Application::$app;
}

function request(): \PHPFramework\Request
{
    return app()->request;
}

function response(): \PHPFramework\Response
{
    return app()->response;
}

function session(): \PHPFramework\Session
{
    return app()->session;
}

function view($view = null,  $data = [], $layout = ''): string|\PHPFramework\View
{
    if ($view) {
        return app()->view->render($view, $data, $layout);
    } else {
        return app()->view;
    }
}

function abort($error = '', $code = 404)
{
    response()->setResponseCode($code);
    echo view('errors/' . $code, ['error' => $error], false);
    die();
}

function base_url($path = ''): string
{
    return PATH . $path;
}

function get_alerts(): void
{
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $key => $value) {
            echo view()->renderPartial("incs/alert_{$key}", ["flash_{$key}" => session()->getFlash($key)]);
        }
    }
}

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

function old($fieldname): string
{

    return isset(session()->get('form_data')[$fieldname]) ? h(session()->get('form_data')[$fieldname]) : '';
}


function h($str): string
{

    return htmlspecialchars($str, ENT_QUOTES);
}

function get_validation_class($fieldname)
{
    $errors = session()->get('form_errors');
    if (empty($errors)) {
        return '';
    }
    return isset($errors[$fieldname]) ? 'is-invalid' : 'is-valid';
}

function get_csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . session()->get('csrf_token') . '">';
}

function get_csrf_meta()
{
    return '<meta name="csrf-token" content="' . session()->get('csrf_token') . '">';
}

function db(){
    return app()->db;
}

function check_auth(){
    return false;
}
