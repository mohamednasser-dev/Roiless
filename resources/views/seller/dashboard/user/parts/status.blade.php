
<span class="switch switch-icon">
                                <label>
                                    <input onchange="update_active(this)" value="{{ $id }}"
                                           type="checkbox" <?php if ($status == 'active') echo "checked";?>>
                                    <span></span>
                                </label>
                            </span>
