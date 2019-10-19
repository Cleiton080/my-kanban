<div class="modal" id="{{ $id }}">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $title }}</h4>
            <button type="button" class="modal-close" onclick="modal.close()">&nbsp;&times;&nbsp;</button>
        </div>
        {{ $slot }}
    </div>
</div>