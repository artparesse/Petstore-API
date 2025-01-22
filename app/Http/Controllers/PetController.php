<?php

namespace App\Http\Controllers;

use App\Http\Requests\Petstore\StorePetRequest;
use App\Http\Requests\Petstore\UpdatePetRequest;
use App\Services\API\ApiInterface;
use App\Services\API\Petstore\PetStatus;
use App\Services\API\Petstore\PetstoreInterface;
use App\Services\PetstoreService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct( private PetstoreService $petstoreService ) {}

    public function index(Request $request): View
    {
        $data = $this->petstoreService->getAllByStatus( $request->get('status') );

        return view('pets.index', [
            'pets' => $data['pets'],
            'currentStatus' => $data['status'],
            'statuses' => PetStatus::cases(),
        ]);
    }

    public function show( int $id ): View {
        $pet = $this->petstoreService->showPet( $id );

        return view('pets.show', compact('pet'));
    }

    public function destroy( int $id ): RedirectResponse {
        $this->petstoreService->deletePet( $id );

        return redirect()->route('pets.index');
    }

    public function edit( int $id ): View {
        $pet = $this->petstoreService->editPet( $id );

        return view('pets.edit', [
            'pet' => $pet,
            'statuses' => PetStatus::cases(),
        ]);
    }

    public function update(UpdatePetRequest $request): RedirectResponse {
        $pet = $this->petstoreService->updatePet($request->validated());

        return redirect()->route('pets.show', ['id' => $pet['id']]);
    }

    public function create(): View {
        return view('pets.create', [
            'statuses' => PetStatus::cases(),
        ]);
    }

    public function store(StorePetRequest $request): RedirectResponse {
        $pet = $this->petstoreService->createPet($request->validated());

        return redirect()->route('pets.show', ['id' => $pet['id']]);
    }
}
