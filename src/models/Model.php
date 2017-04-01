<?php
namespace jorgeandco\hw3\models;

abstract class Model
{
    abstract public function read($arrayGET);
    abstract public function update($arrayPOST);
}