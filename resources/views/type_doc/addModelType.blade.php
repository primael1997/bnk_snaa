<!--Success theme Modal -->
<div class="modal-success me-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="success" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel110"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel110">
                        Ajout d'un type de document
                    </h5>
                    <button type="button" class="close"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="{{route('admin.type-document.store')}}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nom</label>
                                        <input type="text"  class="form-control" name="name" placeholder="Nom du type de document">
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Valider</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Fermer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
