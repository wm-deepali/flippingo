  <div class="modal fade" id="fieldEditModal" tabindex="-1" aria-labelledby="fieldEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <div>
        <h5 class="modal-title" id="fieldEditModalLabel">Edit Field</h5>
        <small class="text-muted">Keyboard shortcuts: Ctrl+C to copy, Delete to remove, Esc to close</small>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="fieldEditForm">
        <input type="hidden" id="edit-field-id" name="field_id">
        <div id="fieldEditFields"></div>
      </form>
      </div>
      <div class="modal-footer">
      <div class="me-auto">
        <button type="button" class="btn btn-danger" id="deleteFieldBtn" title="Delete this field permanently">
        <i class="fas fa-trash me-1"></i> Delete
        </button>
        <button type="button" class="btn btn-info" id="copyFieldBtn" title="Copy this field to create a duplicate">
        <i class="fas fa-copy me-1"></i> Copy
        </button>
      </div>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" id="saveFieldEditBtn">Save</button>
      </div>
    </div>
    </div>
  </div><?php /**PATH D:\web-mingo-project\flippingo_admin\flippingo\resources\views/admin/form/partials/field-edit-modal.blade.php ENDPATH**/ ?>