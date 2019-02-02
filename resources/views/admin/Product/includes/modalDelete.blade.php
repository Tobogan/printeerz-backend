<div class="modal fade" id="modalDeleteCustomer" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCustomerLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer ce produit?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir de supprimer <b>{{ $product->title }}</b> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a href="{{route('destroy_product', $product->id)}}" class="btn btn-danger">Supprimer</a>
            </div>
            </div>
        </div>
    </div>
