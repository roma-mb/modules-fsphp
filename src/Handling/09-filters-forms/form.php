<form action="./" method="<?= $form->method; ?>" id="loginForm" name="loginForm" enctype="multipart/form-data" novalidate>
    <p style="margin-bottom: 10px; text-align: right"><a href="./" title="update">Update...</a></p>
    <div class="col12">
        <input type="text" name="name" id="name" placeholder="Name" value="<?= $form->name; ?>">
        <input type="email" name="email" id="email" placeholder="Email" value="<?= $form->email; ?>">
    </div>
    <button>Send</button>
</form>
