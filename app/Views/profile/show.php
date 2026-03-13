<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Student Profile</h2>

<div class="card shadow border-0">
    <div class="card-body">

        <div class="text-center mb-4">

            <?php if (!empty($user['profile_image'])): ?>

                <img
                    src="<?= base_url('uploads/profiles/'.$user['profile_image']) ?>"
                    class="profile-avatar">

            <?php endif; ?>

        </div>

        <dl class="row">

            <dt class="col-sm-3 fw-semibold">Name</dt>
            <dd class="col-sm-9"><?= esc($user['name']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Email</dt>
            <dd class="col-sm-9"><?= esc($user['email']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Student ID</dt>
            <dd class="col-sm-9"><?= esc($user['student_id']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Course</dt>
            <dd class="col-sm-9"><?= esc($user['course']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Year Level</dt>
            <dd class="col-sm-9"><?= esc($user['year_level']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Section</dt>
            <dd class="col-sm-9"><?= esc($user['section']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Phone</dt>
            <dd class="col-sm-9"><?= esc($user['phone']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Address</dt>
            <dd class="col-sm-9"><?= esc($user['address']) ?></dd>

            <dt class="col-sm-3 fw-semibold">Account Created</dt>
            <dd class="col-sm-9">
                <?= date('F d, Y • h:i A', strtotime($user['created_at'])) ?>
            </dd>

            <?php if(!empty($user['updated_at'])): ?>

                <dt class="col-sm-3 fw-semibold">Last Updated</dt>
                <dd class="col-sm-9">
                    <?= date('F d, Y • h:i A', strtotime($user['updated_at'])) ?>
                </dd>

            <?php endif; ?>

        </dl>

        <div class="mt-4">
            <a href="/profile/edit" class="btn btn-primary">
                Edit Profile
            </a>
        </div>

    </div>
</div>

<style>
    .profile-avatar {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #e5e7eb;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<?= $this->endSection() ?>