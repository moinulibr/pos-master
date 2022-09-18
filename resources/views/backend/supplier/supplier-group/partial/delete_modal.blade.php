
<div class="modal fade show" id="deleteConfirmationModal" aria-modal="true">
    <div class="modal-dialog modal-sm">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Delete
                    <span class="font-weight-light">Supplier Group</span>
                    <br />
                    <small class="text-muted deletingSupplierGroupName"></small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <span>Do you want to delete this ? </span>
                <input type="hidden" class="deletingSupplierGroupId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary deletingSupplierGroupButton">Delete</button>
            </div>
        </form>
    </div>
</div>