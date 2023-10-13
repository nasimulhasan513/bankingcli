<?php

function start_session(): bool
{
    return session_start();
}

function set_session_var(string $name, $value): void
{
    $_SESSION[$name] = $value;
}

function user()
{

    $user['id'] = get_session_var('user_id');
    $user['name'] = get_session_var('user_name');
    $user['email'] = get_session_var('user_email');
    $user['balance'] = get_session_var('balance');
    $user['role'] = get_session_var('role');
    return $user;
}
function setuser($user)
{
    set_session_var('user_id', $user['id']);
    set_session_var('user_name', $user['name']);
    set_session_var('user_email', $user['email']);
    set_session_var('balance', $user['balance']);
    set_session_var('role', $user['role']);

}

function get_session_var(string $name)
{
    return $_SESSION[$name] ?? null;
}

function session_var_exists(string $name): bool
{
    return isset($_SESSION[$name]);
}

function destroy_session(): bool
{
    return session_destroy();
}
