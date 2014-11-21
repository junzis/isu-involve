<h3>TA/Staff applicants that are not selected</h3>

<hr/>

<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <?php foreach ($johns as $john) : ?>
        <tr>
            <td><?php echo $john['User']['name']; ?></td>
            <td><?php echo $john['User']['email']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<hr/>

<div class="alert alert-info"> For sending emails to all: <br/><strong>First check the table carefully, then copy and paste the following address to BCC.</strong> </div>
<div class="well" style="font-size:80%">
    <?php foreach ($johns as $john) { echo $john['User']['email'].', '; } ?>
</div>
