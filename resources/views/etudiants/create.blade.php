@extends('layouts.app')

@section('title', 'Ajouter un Étudiant')

@section('content')
    <div class="page-header">
        <h2>Ajouter un Étudiant</h2>
        <p class="subtitle">Remplissez le formulaire pour ajouter un nouvel étudiant</p>
    </div>

    <div class="form-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erreurs de validation :</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('etudiants.store') }}" method="POST" class="student-form">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nom">Nom <span class="required">*</span></label>
                    <input type="text"
                           id="nom"
                           name="nom"
                           value="{{ old('nom') }}"
                           class="form-control @error('nom') is-invalid @enderror"
                           placeholder="Ex: DIALLO">
                    @error('nom')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom <span class="required">*</span></label>
                    <input type="text"
                           id="prenom"
                           name="prenom"
                           value="{{ old('prenom') }}"
                           class="form-control @error('prenom') is-invalid @enderror"
                           placeholder="Ex: Mamadou">
                    @error('prenom')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="Ex: mamadou.diallo@example.com">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="filiere">Filière <span class="required">*</span></label>
                    <select id="filiere"
                            name="filiere"
                            class="form-control @error('filiere') is-invalid @enderror">
                        <option value="">-- Choisir une filière --</option>
                        <option value="Informatique" {{ old('filiere') == 'Informatique' ? 'selected' : '' }}>Informatique</option>
                        <option value="Gestion" {{ old('filiere') == 'Gestion' ? 'selected' : '' }}>Gestion</option>
                        <option value="Droit" {{ old('filiere') == 'Droit' ? 'selected' : '' }}>Droit</option>
                        <option value="Économie" {{ old('filiere') == 'Économie' ? 'selected' : '' }}>Économie</option>
                        <option value="Médecine" {{ old('filiere') == 'Médecine' ? 'selected' : '' }}>Médecine</option>
                        <option value="Ingénierie" {{ old('filiere') == 'Ingénierie' ? 'selected' : '' }}>Ingénierie</option>
                    </select>
                    @error('filiere')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="niveau">Niveau <span class="required">*</span></label>
                    <select id="niveau"
                            name="niveau"
                            class="form-control @error('niveau') is-invalid @enderror">
                        <option value="">-- Choisir un niveau --</option>
                        <option value="L1" {{ old('niveau') == 'L1' ? 'selected' : '' }}>L1</option>
                        <option value="L2" {{ old('niveau') == 'L2' ? 'selected' : '' }}>L2</option>
                        <option value="L3" {{ old('niveau') == 'L3' ? 'selected' : '' }}>L3</option>
                        <option value="M1" {{ old('niveau') == 'M1' ? 'selected' : '' }}>M1</option>
                        <option value="M2" {{ old('niveau') == 'M2' ? 'selected' : '' }}>M2</option>
                    </select>
                    @error('niveau')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="age">Âge <span class="required">*</span></label>
                    <input type="number"
                           id="age"
                           name="age"
                           value="{{ old('age') }}"
                           class="form-control @error('age') is-invalid @enderror"
                           min="16"
                           max="100"
                           placeholder="Ex: 22">
                    @error('age')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date_naissance">Date de naissance <span class="required">*</span></label>
                    <input type="date"
                           id="date_naissance"
                           name="date_naissance"
                           value="{{ old('date_naissance') }}"
                           class="form-control @error('date_naissance') is-invalid @enderror">
                    @error('date_naissance')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel"
                       id="telephone"
                       name="telephone"
                       value="{{ old('telephone') }}"
                       class="form-control @error('telephone') is-invalid @enderror"
                       placeholder="Ex: +224 620 00 00 00">
                @error('telephone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="adresse">Adresse</label>
                <textarea id="adresse"
                          name="adresse"
                          rows="3"
                          class="form-control @error('adresse') is-invalid @enderror"
                          placeholder="Ex: Kaloum, Conakry, Guinée">{{ old('adresse') }}</textarea>
                @error('adresse')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                    </svg>
                    Enregistrer
                </button>
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Annuler
                </a>
            </div>

            <p class="form-note">
                <span class="required">*</span> Champs obligatoires
            </p>
        </form>
    </div>
@endsection
