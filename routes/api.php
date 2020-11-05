<?php

use Illuminate\Http\Request;

/*

| What is API?
  API- Application Programming Interface. It is an inteface between 2 programming languages/ server to the client
  or one technology to another technology.
  The API can be used in mobile as well as the web app.

| Make controller and route for it

| Config Database with the project

| Make Model

| Write some code

| Test the API


*/

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list', 'Users@list');
