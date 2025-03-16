<!-- Modal Editar Retal -->
<div class="modal fade" id="modalEditarRetal" tabindex="-1" aria-labelledby="modalEditarRetalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarRetalLabel">Editar Retal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarRetal">
                    <input type="hidden" id="edit-retal-id">

                    <div class="mb-3">
                        <label for="edit-tejido" class="form-label">Tejido</label>
                        <input type="text" class="form-control" id="edit-tejido">
                    </div>
                    <div class="mb-3">
                        <label for="edit-subcategoria" class="form-label">Subcategoría</label>
                        <input type="text" class="form-control" id="edit-subcategoria">
                    </div>
                    <div class="mb-3">
                        <label for="edit-gama" class="form-label">Gama</label>
                        <input type="text" class="form-control" id="edit-gama">
                    </div>
                    <div class="mb-3">
                        <label for="edit-color-primario" class="form-label">Color Primario</label>
                        <input type="text" class="form-control" id="edit-color-primario">
                    </div>
                    <div class="mb-3">
                        <label for="edit-color-secundario" class="form-label">Color Secundario</label>
                        <input type="text" class="form-control" id="edit-color-secundario">
                    </div>
                    <div class="mb-3">
                        <label for="edit-metros" class="form-label">Metros</label>
                        <input type="number" step="0.01" class="form-control" id="edit-metros">
                    </div>
                    <div class="mb-3">
                        <label for="edit-precio-base" class="form-label">Precio Base</label>
                        <input type="number" step="0.01" class="form-control" id="edit-precio-base">
                    </div>
                    <div class="mb-3">
                        <label for="edit-precio-retal" class="form-label">Precio Retal</label>
                        <input type="number" step="0.01" class="form-control" id="edit-precio-retal">
                    </div>
                    <div class="mb-3">
                        <label for="edit-estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="edit-estado">
                    </div>
                    <div class="mb-3">
                        <label for="edit-descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit-descripcion"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Retal -->
<div class="modal fade" id="modalEliminarRetal" tabindex="-1" aria-labelledby="modalEliminarRetalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarRetalLabel">Eliminar Retal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este retal?</p>
                <p><strong>Tejido:</strong> <span id="delete-tejido"></span></p>
                <p><strong>Metros:</strong> <span id="delete-metros"></span></p>
                <input type="hidden" id="delete-retal-id">
                <button class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Agregar Retal -->
<div class="modal fade" id="modalAgregarRetal" tabindex="-1" aria-labelledby="modalAgregarRetalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalAgregarRetalLabel">Añadir Retal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarRetal">
                    <div class="row">
                        <!-- Tejido -->
                        <div class="col-md-6 mb-3">
                            <label for="add-tejido" class="form-label visually-hidden">Tejido</label>
                            <select class="form-control" id="add-tejido" required>
                                <option class="text-grey" value="" selected disabled>- Tejido -</option>
                                @foreach ($tejidos as $tejido)
                                    <option value="{{ $tejido }}">{{ ucfirst($tejido) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Subcategoría -->
                        <div class="col-md-6 mb-3">
                            <label for="add-subcategoria" class="form-label visually-hidden">Subcategoría</label>
                            <select class="form-control" id="add-subcategoria" required>
                                <option value="" selected disabled>- Subcategoría -</option>
                                @foreach ($subcategorias as $subcategoria)
                                    <option value="{{ $subcategoria }}">{{ ucfirst($subcategoria) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Color 1 -->
                        <div class="col-md-6 mb-3">
                            <label for="add-color-primario" class="form-label visually-hidden">Color Primario</label>
                            <input type="text" class="form-control" id="add-color-primario"
                                placeholder="Color Primario" required>
                        </div>
                        <!-- Color 2 -->
                        <div class="col-md-6 mb-3">
                            <label for="add-color-secundario" class="form-label visually-hidden">Color
                                Secundario</label>
                            <input type="text" class="form-control" id="add-color-secundario"
                                placeholder="Color Secundario" required>
                        </div>
                        <!-- Gama -->
                        <div class="col-md-6 mb-3">
                            <label for="add-gama" class="form-label visually-hidden">Gama</label>
                            <select class="form-control" id="add-gama" required>
                                <option value="" selected disabled>- Gama -</option>
                                @foreach ($gamas as $gama)
                                    <option value="{{ $gama }}">{{ ucfirst($gama) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Metros -->
                        <div class="col-md-6 mb-3">
                            <label for="add-metros" class="form-label visually-hidden">Metros</label>
                            <input type="number" step="0.01" class="form-control" id="add-metros"
                                min="0.01" max="9.99" placeholder="Metros" required>
                        </div>
                        <!-- Precio base -->
                        <div class="col-md-6 mb-3">
                            <label for="add-precio-base" class="form-label visually-hidden">Precio Base</label>
                            <input type="number" step="0.01" class="form-control" id="add-precio-base"
                                min="0" max="999.99" placeholder="Precio base" required>
                        </div>
                        <!-- Precio retal -->
                        <div class="col-md-6 mb-3">
                            <label for="add-precio-retal" class="form-label visually-hidden">Precio Retal</label>
                            <input type="number" step="0.01" class="form-control" id="add-precio-retal"
                                min="0" max="999.99" placeholder="Precio retal" required>
                        </div>
                        <!-- Estado -->
                        {{--  REVISAR - Al crear retal siempre estará disponible, eliminar este campo --}}
                        {{-- Se sustituirá el campo por el de agregar un archivo de imagen --}}
                        {{-- <div class="d-flex justify-content-center">
                            <div class="col-md-6 mb-3">
                                <label for="add-estado" class="form-label visually-hidden">Estado</label>
                                <select class="form-control" id="add-estado" required>
                                    <option value="" selected disabled>- Estado -</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado }}">{{ ucfirst($estado) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <!-- Descripción -->
                        <div class="col-md-12 mb-3">
                            <label for="add-descripcion" class="form-label visually-hidden">Descripción
                                (Opcional)</label>
                            <textarea class="form-control" placeholder="Agrega una descripción" id="add-descripcion" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
