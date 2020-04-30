<?php

namespace App\Http\Controllers;

use App\Action;
use App\Http\Requests\ActionRequest;
use Illuminate\Http\Request;

class ActionController extends Controller
{

    public function store(ActionRequest $request)
    {
        auth()->user()->addAction($request->validated());

        return redirect('users/'.auth()->id());
    }

    public function update(ActionRequest $request,Action $action)
    {
        $this->authorize('manage', $action);

        $action->update($request->validated());

        return redirect('users/'.auth()->id());
    }

    public function destroy(Action $action)
    {
        $this->authorize('manage', $action);

        $action->delete();

        return redirect(auth()->user()->path());
    }
}
