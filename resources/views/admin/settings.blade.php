@include('admin.include.header')
<div class="page-content">
    <div class="page-title-head d-flex align-items-center gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-bold mb-0 py-2">Admin Profile Settings</h4>
        </div>
    </div>

    <div class="page-container">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Settings</h3>
                    </div>
                    <div class="card-body settings-list">
                        <ul class="nav nav-tabs d-flex flex-column settingTab" id="settingsTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" aria-selected="true" role="tab">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" aria-selected="false" role="tab" tabindex="-1">Security</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="tab-content" id="settingsTabsContent">
                            
                            <!-- Profile Settings -->
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3 class="mb-3"><i class="fa-solid fa-user"></i> Profile Information</h3>
                                <form class="row g-3" method="POST" action="{{ route('admin.settings.update') }}">
                                    @csrf
                                    <input type="hidden" name="tab" value="profile">
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    @if($errors->any())
                                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                                    @endif
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ auth('admin')->user()->name }}" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ auth('admin')->user()->email }}" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Role</label>
                                        <input type="text" class="form-control" value="{{ ucfirst(auth('admin')->user()->role) }}" readonly>
                                    </div>
                                    
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary" type="submit">Update Profile</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Security Settings -->
                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <h3 class="mb-3"><i class="fa-solid fa-lock"></i> Change Password</h3>
                                <form class="row g-3" method="POST" action="{{ route('admin.settings.update') }}">
                                    @csrf
                                    <input type="hidden" name="tab" value="security">
                                    
                                    <div class="col-md-12">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-danger" type="submit"><i class="fa-solid fa-key me-1"></i>Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.include.footer')ption value="Monthly" {{ ($settings['backup_frequency'] ?? '')=='Monthly' ? 'selected' : '' }}>Monthly</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Auto Update</label>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" name="auto_update" {{ ($settings['auto_update'] ?? '0')=='1' ? 'checked' : '' }}>
                <label class="form-check-label">Enable Automatic Updates</label>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Maintenance Mode</label>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" name="maintenance_mode" {{ ($settings['maintenance_mode'] ?? '0')=='1' ? 'checked' : '' }}>
                <label class="form-check-label">Enable Maintenance Mode</label>
              </div>
            </div>
            <div class="col-12 mt-3">
              <button class="btn btn-primary" type="submit">Save System Preferences</button>
            </div>
          </form>
        </div>

      </div>
                            </div>
                            
                        </div>
                       
                    </div>
                </div>






            </div>










        </div>



    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
        $('.accordian-body').on('show.bs.collapse', function () {
            $(this).closest("table")
                .find(".collapse.in .action")
                .not(this)
                .collapse('toggle')
        })
    </script>


 @include('admin.include.footer')