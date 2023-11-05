<div class="tab-pane fade show {{ $account }}" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
    <div class="myaccount-content">
        <h3>Account Details</h3>
        <div class="account-details-form">
            <form action="{{route('account.update')}}" method="post" class="mb-4">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="first-name" class="required">Full Name</label>
                            <input type="text" id="first-name" name="name" value="{{ session('name') }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <label for="last-name" class="required">Mobile Number</label>
                            <input type="number" name="mobile" value="{{ session('mobile') }}"/>
                        </div>
                    </div>
                </div>
                <div class="single-input-item">
                    <label for="display-name" class="required">Address </label>
                    <input type="text" id="display-name" name="address" value='{{session('address')}}'/>
                </div>
                <div class="single-input-item">
                    <label for="email" class="required">Email Addres</label>
                    <input type="email" id="email" name="email" value="{{ session('email') }}"/>
                </div>
                <div class="single-input-item">
                    <button class="check-btn sqr-btn" type="submit">Update</button>
                </div>
            </form>
            <form class="mt-5" method="post" action="{{ route('account.change.password.Update') }}">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="new-pwd" class="required">New Password</label>
                                <input type="password" id="new-pwd" name="new_password"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="confirm-pwd" class="required">Current Password</label>
                                <input type="password" id="confirm-pwd" name="current_password" />
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="single-input-item">
                    <button class="check-btn sqr-btn" type="submit">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>