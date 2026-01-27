<?php

namespace App\Http\Controllers\Shared;

use App\Domains\Shared\Model\Program;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Program::class, 'program');
        $this->middleware('can:isActive,program')->only(['isActive']);
    }


    public function index()
    {
        return response()->json([
            'programs' => Program::query()->orderBy('name')->get()
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:programs,name',
        ]);

        $program->update($validated);

        return response()->json([
            "message" => "Программа успешно обновлена!",
            "program" => $program
        ]);
    }

    public function isActive(Program $program)
    {
        $program->is_active = !$program->is_active;
        $program->save();
        return response()->json([
            "message" => "Статус программы успешно обновлен!",
            'program' => $program,
        ]);
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return response()->json([], 204);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:programs",
        ]);
        $program = Program::create($validated);

        return response()->json([
            "message" => "Программа успешно добавлена!",
            "program" => $program
        ], 201);
    }
}
