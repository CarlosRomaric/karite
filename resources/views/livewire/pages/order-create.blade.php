<div>
    <form wire:submit.prevent="save">
        <div class="flex">
            <div class="w-1/2 mr-5">
                <!-- Champ Lastname -->
                <div class="mb-4 ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                        Nom <b class="text-red-500">*</b>
                    </label>
                    <input name="lastname" wire:model="lastname" value="{{ old('lastname') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" placeholder="Entrez votre nom">
                    @if($errors->has('lastname'))
                        <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </div>
                    @endif
                </div>

                <!-- Champ Email -->
                <div class="mb-4 ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email <b class="text-red-500">*</b>
                    </label>
                    <input name="email" wire:model="email" value="{{ old('email') }}" type="email" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" placeholder="Entrez votre email">
                    @if($errors->has('email'))
                        <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>

                <!-- Champ Type de package -->
                <div class="mb-4 ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="type_package_id">
                        Type de package <b class="text-red-500">*</b>
                    </label>
                    <select name="type_package_id" wire:model="type_package_id" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Choisissez le type de package</option>
                        @foreach ($type_packages as $type_package)
                            <option value="{{ $type_package->id }}">{{ $type_package->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type_package_id'))
                        <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                            <strong>{{ $errors->first('type_package_id') }}</strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-1/2">
                <!-- Champ Firstname -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                        Prénoms <b class="text-red-500">*</b>
                    </label>
                    <input name="firstname" wire:model="firstname" value="{{ old('firstname') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" type="text" placeholder="Entrez votre prénom">
                    @if($errors->has('firstname'))
                        <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </div>
                    @endif
                </div>

                <!-- Champ Phone -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Contact <b class="text-red-500">*</b>
                    </label>
                    <input name="phone" wire:model="phone" onkeypress="return isNumberKey(event)" value="{{ old('phone') }}" maxlength="14" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" type="text" placeholder="Entrez votre contact">
                    @if($errors->has('phone'))
                        <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </div>
                    @endif
                </div>

                <!-- Champ Quantity -->
                <div class="mb-4 ">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                        Quantité <b class="text-red-500">*</b>
                    </label>
                    <input name="quantity" wire:model="quantity" onkeypress="return isNumberKey(event)" value="{{ old('quantity') }}" class="shadow focus:border-amber-300 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" type="text" placeholder="Entrez la quantité">
                    @if($errors->has('quantity'))
                        <div class="bg-red-200 text-red-700 rounded py-5 px-4 mt-2">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </div>
                    @endif
                </div>

                <!-- Bouton de soumission -->
                <div class="mb-4">
                    <button type="submit" class="bg-amber-900 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Soumettre</button>
                </div>
            </div>
        </div>
    </form>
</div>


@push('javascript')
<script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('order-saved', event => {
                Swal.fire({
                    title: 'Commande enregistrée !',
                    text: event.detail.message || 'Votre commande a été enregistrée avec succès. Vous recevrez la proforma par email.',
                    icon: 'success',
                    confirmButtonText: 'Ok',  // Bouton de confirmation
                    customClass: {
                        confirmButton: 'bg-amber-900 text-white px-4 py-2 rounded'  // Customiser le bouton
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Action à prendre après que l'utilisateur a confirmé
                        console.log('Commande confirmée');
                    }
                });
            });

            

            // Fonction pour bloquer les caractères non-numériques pendant la saisie
            function isNumberKey(event) {
                var charCode = (event.which) ? event.which : event.keyCode;
                // Si la touche tapée n'est pas un chiffre (0-9) ou touche de contrôle (backspace, etc.), bloquer l'entrée
                if (charCode < 48 || charCode > 57) {
                    event.preventDefault();
                    return false;
                }
                return true;
            }

            // Fonction pour formater le numéro de contact
            function formatPhoneNumber(input) {
                // Supprimer tous les espaces existants et reformater
                let cleaned = input.value.replace(/\D/g, '');
                let formatted = cleaned.replace(/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5');
                input.value = formatted;
            }

            // Appliquer le formatage à chaque frappe de touche
            document.getElementById('phone').addEventListener('input', function (event) {
                formatPhoneNumber(event.target);
            });

            // Fonction pour valider le champ après la saisie (input) afin de corriger les copier-coller
            function validateNumberInput(input) {
                // Remplacer tout caractère non numérique par une chaîne vide
                input.value = input.value.replace(/[^0-9]/g, '');
            }

            // Assurez-vous que les fonctions sont accessibles dans la portée globale
            window.isNumberKey = isNumberKey;
            window.validateNumberInput = validateNumberInput;
        });
        
</script>

@endpush