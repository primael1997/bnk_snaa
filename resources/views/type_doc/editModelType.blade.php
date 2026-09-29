<form class="form form-vertical" action="{{route('admin.type-document.update', $type->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="first-name-vertical">Nom</label>
                    <input type="text" value="{{$typ->name}}" class="form-control" name="name" placeholder="Nom du type de document">
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Modifier</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Annuler</button>
            </div>
        </div>
    </div>
</form>
