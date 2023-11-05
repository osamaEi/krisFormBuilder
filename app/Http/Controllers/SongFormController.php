<?php

namespace App\Http\Controllers;
use App\Forms\SongForm;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Field;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;

class SongFormController extends Controller
{
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->createByArray([
                        [
                            'name' => 'name',
                            'type' => Field::TEXT,
                        ],
                        [
                            'name' => 'address',
                            'type' => Field::TEXT,
                        ],
                        [
                            'name' => 'lyrics',
                            'type' => Field::TEXTAREA,
                        ],
                        [
                            'name' => 'publish',
                            'type' => Field::CHECKBOX
                        ],
                    ]
            ,[
            'method' => 'POST',
            'url' => route('songs.store')
        ]);

        return view('song', compact('form'));
    }



    public function store(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(\App\Forms\SongForm::class);
        $form->redirectIfNotValid();
        
        $songForm = new SongForm();
        $songForm->fill($request->only(['name', 'artist']))->save();

        // Do redirecting...
    }

    public function update(int $id, Request $request)
    {
        $songForm = SongForm::findOrFail($id);

        $form = $this->getForm($songForm);
        $form->redirectIfNotValid();

        $songForm->update($form->getFieldValues());

        // Do redirecting...
    }



}

