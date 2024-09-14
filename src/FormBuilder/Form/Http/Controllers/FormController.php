<?php

namespace FormBuilder\Form\Http\Controllers;

use App\Http\Controllers\Controller;
use FormBuilder\Form\Models\Form;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FormController extends Controller
{
    public function index()
    {
        return Inertia::render('Forms/Index', [
            'forms' =>  Auth::user()->forms
        ]);
    }

    public function create()
    {
        return Inertia::render('Forms/Create', [
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'fields' => ['required']
        ]);

        Auth::user()->forms()->create($request->all());

        return Redirect::route('forms.index')->with('success', 'Object opgeslagen');
    }

    public function edit(Form $form)
    {
        if (!Auth::user()->forms->contains($form)) return Redirect::route('forms.index');

        return Inertia::render('Forms/Edit', [
            'form' => $form
        ]);
    }

    public function update(Form $form, Request $request)
    {
        if (!Auth::user()->forms->contains($form)) return Redirect::route('forms.index');

        $request->validate([
            'name' => ['required'],
            'fields' => ['required'],
        ]);

        $form->update($request->all());

        return Redirect::route('forms.index')->with('success', 'Form updated');
    }

    public function single(Form $form)
    {
        return $form;
    }


    public function post(Form $form, Request $request)
    {

        $onlyFields = [];
        $validateFields = [];

        foreach($form->fields as $field) {
            $validateFields[$field['name']] = $this->getRequiredFields($field);
            $onlyFields[] = $field['name'];
        }

        $request->validate($validateFields);

        $form->submissions()->create([
            'fields' => json_encode($request->only($onlyFields))
        ]);


        return $form;
    }

    public function getRequiredFields($field)
    {
        $validationRules = [];
        $validationRules[] = $field['required'] ? 'required' : 'nullable';

        if ($field['type'] == 'email') {
            $validationRules[] = 'email';
        }
        return $validationRules;
    }
}
