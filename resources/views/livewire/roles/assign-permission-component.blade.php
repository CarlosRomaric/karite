
<div>
<label for="" class="text-2xl font-bold">Assignation de permission au role {{ $role->name }}</label>
    <form method="post" action="{{ route('roles.permission.assign', ['role' => $role->id]) }}" class="w-full p-10">
        @csrf
        <div class="flex gray-400 mb-6">
            <div class="w-full px-3 md:mb-0">
                <label class="custom-checkbox-label flex">
                    <div class="bg-gray-300 shadow border-amber-600 w-6 h-6 p-1 flex justify-center items-center mr-2">
                        <input type="checkbox" id="select-all-checkbox" value="all" class="hidden">
                        <svg class="hidden w-4 h-4 text-amber-700 pointer-events-none" viewBox="0 0 172 172">
                            <g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal">
                                <path d="M0 172V0h172v172z"/>
                                <path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="2"/>
                            </g>
                        </svg>
                    </div>
                    <span class="select-none text-md text-black">Tout sélectionner / Tout désélectionner</span>
                </label>
            </div>
        </div>
        <div class="grid grid-cols-4 justify-start">
            @for($i = 0; $i < 4; $i++)
                @if($i != 3)
                    <div>
                        @for($k = $i * $perPage; $k < ($i + 1) * $perPage; $k++)
                            <label class="custom-checkbox-label flex my-4">
                                <div class="bg-gray-300 shadow border-amber-600 w-6 h-6 p-1 flex justify-center items-center mr-2">
                                    <input type="checkbox" {{ ($role->hasPermission($permissions[$k])) ? 'checked' : '' }} name="permission_id[]" value="{{ $permissions[$k]->id }}" class="hidden">
                                    <svg class="hidden w-4 h-4 text-amber-700 pointer-events-none" viewBox="0 0 172 172">
                                        <g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal">
                                            <path d="M0 172V0h172v172z"/>
                                            <path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </div>
                                <span class="select-none">{{ $permissions[$k]->name }}</span>
                            </label>
                            @if($k < (($i + 1) * $perPage) - 1)
                                @if(explode(' ', $permissions[$k]->name)[1]  != explode(' ', $permissions[$k + 1]->name)[1])
                                    <br>
                                @endif
                            @endif
                        @endfor
                    </div>
                @endif
                @if($i == 3)
                    <div>
                        @for($k = $i * $perPage; $k < $permissions->count(); $k++)
                            <label class="custom-checkbox-label flex my-4">
                                <div class="bg-gray-300 shadow border-amber-600 w-6 h-6 p-1 flex justify-center items-center mr-2">
                                    <input type="checkbox" {{ ($role->hasPermission($permissions[$k])) ? 'checked' : '' }} name="permission_id[]" value="{{ $permissions[$k]->id }}" class="hidden">
                                    <svg class="hidden w-4 h-4 text-amber-700 pointer-events-none" viewBox="0 0 172 172">
                                        <g fill="none" stroke-width="none" stroke-miterlimit="10" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal">
                                            <path d="M0 172V0h172v172z"/>
                                            <path d="M145.433 37.933L64.5 118.8658 33.7337 88.0996l-10.134 10.1341L64.5 139.1341l91.067-91.067z" fill="currentColor" stroke-width="2"/>
                                        </g>
                                    </svg>
                                </div>
                                <span class="select-none">{{ $permissions[$k]->name }}</span>
                            </label>
                            @if($k < $permissions->count() - 1)
                                @if(explode(' ', $permissions[$k]->name)[1] != explode(' ', $permissions[$k + 1]->name)[1])
                                    <br>
                                @endif
                            @endif
                        @endfor
                    </div>
                @endif
            @endfor
        </div>
        @if ($errors->has('permission_id'))
            <br>
            <p class="text-red-500 text-sm">{{ $errors->first('permission_id') }}</p>
            <br>
        @endif
        <br>
        <div class="px-8 mt-8 flex justify-end items-center">
            <button class="focus:outline-none flex items-center btn-amber-800" type="submit">Enregistrer</button>
        </div>
    </form>
</div>
@push('scripts')
    <script src="{{ asset('js/select-checkbox.js') }}"></script>
@endpush

