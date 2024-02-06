<?php
$users = get_option('moxcar_subscribers');
$post_url = admin_url('admin.php?page=moxcar-post-plugin');
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = $_POST['user_id'];
    
    if ($action == 'delete') {
        unset($users[$id]);
        update_option('moxcar_subscribers', $users);
    } else if ($action == 'add-subscriber') {
        $new_user = [
            'name' => $_POST['post-title'],
            'email' => $_POST['post-email'],
            'is_active' => $_POST['is_active']
        ];
        $users[] = $new_user;
        update_option('moxcar_subscribers', $users);
    } else if ($action == 'update') {
        $users[$id]['name'] = $_POST['post-title'];
        $users[$id]['email'] = $_POST['post-email'];
        $users[$id]['is_active'] = $_POST['is_active'];
        update_option('moxcar_subscribers', $users);
    }
}

?>

<main>
    <h2>Subscribers List</h2>

    <section class="add-subscriber-form">
        <form action="<?php echo $post_url ?>" method="post">
            <input type="text" name="post-title" id="post-title" placeholder="Name">
            <input type="email" name="post-email" id="post-email" placeholder="Email">

            <select name="is_active" id="is_active">
                
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

            <button type="submit">Add Subscriber</button>
            <input type="hidden" name="action" value="add-subscriber">
        </form>
    </section>

    <section class="subscribers-grid">
        <?php if (empty($users)) : ?>
            <p>No Subscribers exist.</p>
        <?php else : ?>
            <?php foreach ($users as $index => $user) : ?>
                <article id="<?php echo esc_attr($index); ?>" class="subscribers-card">
                    <div class="subscribers-card-info">
                        <header class="subscribers-name">
                            <h3><?php echo esc_html($user['name']); ?></h3>
                        </header>

                        <div class="subscriber-active">
                            <div class="<?php echo $user['is_active'] ? 'active-circle' : 'inactive-circle'; ?>"></div>
                            <p><?php echo $user['is_active'] ? 'Active' : 'Inactive'; ?></p>
                        </div>

                        <address class="subscriber-email">
                            <p>
                                <strong>Email:</strong>
                                <a role="button" tabIndex="0" href="mailto:<?php echo esc_html($user['email']); ?>">
                                    <?php echo esc_html($user['email']); ?>
                                </a>
                            </p>
                        </address>

                        <div class="subscriber-options">
                            <div class="options-dots">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </div>
                    </div>

                    <div class="subscriber-option-forms">
                        <form action="<?php echo $post_url ?>" method="post">
                            <input type="text" name="post-title" id="post-title" value="<?php echo esc_html($user['name']); ?>">
                            <input type="email" name="post-email" id="post-email" value="<?php echo esc_html($user['email']); ?>">

                            <select name="is_active" id="is_active">
                            <option <?php echo $user['is_active'] ? 'selected' : ''; ?> value="1">Active</option>
                                <option <?php echo $user['is_active'] ? '' : 'selected'; ?> value="0">Inactive</option>
                               
                            </select>

                            <div class="delete-user-checkbox-container">
                                <label for="delete_user">Delete User</label>
                                <input type="checkbox" name="delete_user" id="delete_user" style="transform: translateY(2px);">
                            </div>

                            <button type="submit">Update User</button>
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="user_id" value="<?php echo esc_attr($index); ?>">
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>
