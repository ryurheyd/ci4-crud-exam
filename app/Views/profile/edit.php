<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Edit Profile</h2>

<div class="card shadow border-0">
    <div class="card-body">

        <form method="post" action="/profile/update" enctype="multipart/form-data">

            <?= csrf_field() ?>

            <input type="hidden" name="remove_image" id="remove_image" value="0">

            <div class="text-center mb-4">

                <div class="image-wrapper">

                    <?php if (!empty($user['profile_image'])): ?>

                        <img
                            id="preview"
                            src="<?= base_url('uploads/profiles/' . $user['profile_image']) ?>"
                            class="profile-avatar">

                        <button
                            type="button"
                            id="removeBtn"
                            class="remove-btn"
                            onclick="removeImage()">×</button>

                    <?php else: ?>

                        <img
                            id="preview"
                            src=""
                            class="profile-avatar"
                            style="display:none;">

                        <button
                            type="button"
                            id="removeBtn"
                            class="remove-btn"
                            style="display:none;"
                            onclick="removeImage()">×</button>

                    <?php endif; ?>

                </div>

                <div class="mt-3">

                    <label class="form-label">
                        Upload New Profile Image
                    </label>

                    <input
                        type="file"
                        name="profile_image"
                        class="form-control"
                        accept="image/*"
                        onchange="previewImage(event)">

                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name"
                    class="form-control"
                    value="<?= old('name', $user['name']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email"
                    class="form-control"
                    value="<?= old('email', $user['email']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text" name="student_id"
                    class="form-control"
                    value="<?= old('student_id', $user['student_id']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <input type="text" name="course"
                    class="form-control"
                    value="<?= old('course', $user['course']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Year Level</label>
                <input type="number" name="year_level"
                    class="form-control"
                    value="<?= old('year_level', $user['year_level']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Section</label>
                <input type="text" name="section"
                    class="form-control"
                    value="<?= old('section', $user['section']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone"
                    class="form-control"
                    value="<?= old('phone', $user['phone']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address"
                        class="form-control"><?= old('address', $user['address']) ?></textarea>
            </div>

            <button class="btn btn-primary">
                Update Profile
            </button>

        </form>

    </div>
</div>

<style>
    .image-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 3px solid #e5e7eb;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        line-height: 26px;
    }

    .remove-btn:hover {
        background: #dc2626;
    }
</style>

<script>
    function previewImage(event) {
        const file = event.target.files[0];

        if (!file) return;

        if (!file.type.startsWith("image/")) {
            alert("Upload failed. Please select a valid image file (JPG, JPEG, PNG, or WEBP).");
            event.target.value = "";
            return;
        }

        const reader = new FileReader();

        reader.onload = function() {
            const preview = document.getElementById('preview');
            const removeBtn = document.getElementById('removeBtn');

            preview.src = reader.result;
            preview.style.display = "block";

            removeBtn.style.display = "block";

            document.getElementById("remove_image").value = "0";
        }

        reader.readAsDataURL(file);
    }

    function removeImage() {
        const preview = document.getElementById("preview");
        const removeBtn = document.getElementById("removeBtn");

        preview.src = "";
        preview.style.display = "none";

        removeBtn.style.display = "none";

        document.getElementById("remove_image").value = "1";

        document.querySelector('input[name="profile_image"]').value = "";
    }
</script>

<?= $this->endSection() ?>