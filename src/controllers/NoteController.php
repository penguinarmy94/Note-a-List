<?php

class NoteController extends Controller
{
	public __construct($model, $view)
	{
		this->$model = $model;
		this->$view = $view;
	}
	
	public presentNote($noteID, $locationID)
	{
		
	}
}