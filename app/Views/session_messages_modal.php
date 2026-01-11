<?php
// session_messages_modal.php

// Verificam si extragem mesajul din sesiune
$modal_message = null;

if (isset($_SESSION['success'])) {
    $modal_message = [
        'title' => 'Success!',
        'content' => htmlspecialchars($_SESSION['success']),
        'class' => 'modal-header bg-success text-white'
    ];
    // stergem variabila de sesiune
    unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {
    $modal_message = [
        'title' => 'Error!',
        'content' => htmlspecialchars($_SESSION['error']),
        'class' => 'modal-header bg-danger text-white'
    ];
    // stergem variabila de sesiune
    unset($_SESSION['error']);
}
?>

<?php if ($modal_message): ?>
    <div class="modal fade" id="sessionMessageModal" tabindex="-1" aria-labelledby="sessionMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="<?php echo $modal_message['class']; ?>">
                    <h5 class="modal-title" id="sessionMessageModalLabel"><?php echo $modal_message['title']; ?></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $modal_message['content']; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Folosim jQuery pentru a afisa automat modalul imediat dupa ce documentul este gata
        $(document).ready(function() {
            $('#sessionMessageModal').modal('show');
        });
    </script>
<?php endif; ?>