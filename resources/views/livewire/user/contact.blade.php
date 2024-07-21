@extends('livewire.user.index')
@section('content')
<section id="ContactPage">
    <div class="contact-title">
        <div class="">CONTACT US IF U WANNA MAKE UR DREAM HOUSE</div>

    </div>
    <div class="container mt-5 p-4">
        <div>
            {{ Breadcrumbs::render('contact') }}
        </div>
        <div class=" row row-cols-lg-2 row-cols-md-1 feedback-container">
            <div class="col get-in-touch">
                <div class="d-flex flex-row justify-content-center align-items-center gap-2 get-in-touch-title">
                    <span class="material-symbols-outlined">
                        temp_preferences_eco
                    </span>
                    <h6>Get in touch</h6>
                </div>
                <div class="contact-subtitle">
                    <h2>Reach Us</h2>
                </div>
                <div class="contact-item d-flex flex-md-row flex-sm-column gap-4 p-3 align-items-center w-100">
                    <div class="p-3 contact-item-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="d-flex flex-column gap-2 contact-item-title">
                        <h3>Office Address</h3>
                        <p>285 P. Đội Cấn, Liễu Giai, Ba Đình, Hà Nội</p>
                    </div>
                </div>
                <div class="contact-item d-flex flex-md-row flex-sm-column gap-4 p-3 align-items-center w-100">
                    <div class="p-3 contact-item-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="d-flex flex-column gap-2 contact-item-title">
                        <h3>Phone Number</h3>
                        <div>
                            <p> +84 924 600 804</p>
                            <p> +84 328 824 552</p>
                        </div>
                    </div>
                </div>
                <div class="contact-item d-flex flex-md-row flex-sm-column gap-4 p-3 align-items-center w-100">
                    <div class="p-3 contact-item-icon">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <div class="d-flex flex-column gap-2 flex-wrap contact-item-title">
                        <h3>Email Us</h3>
                        <p class="">gethsenami2024@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col form-feedback-container">
                <form action="" wire:submit="feedback" wire:loading.class="opacity-75">
                    <div class="d-flex flex-row justify-content-center align-items-center gap-2 feedback-title">
                        <span class="material-symbols-outlined">
                            forum
                        </span>
                        <h6>Feed Back</h6>
                    </div>
                    <div class="form-feedback-item">
                        <input wire:model="name" type="text" autocomplete="off" required id="name-contact" name="name-contact" placeholder="Name">
                        <label for="name-contact">Name</label>

                    </div>
                    <div class="form-feedback-item">
                        <input wire:model="email" type="text" autocomplete="off" required id="email-contact" name="email-contact" placeholder="Email">
                        <label for="email-contact">Email</label>
                    </div>
                    <div class="form-feedback-item">
                        <input wire:model="phone" type="text" name="phonenumber-contact" autocomplete="off" required id="phonenumber-contact" placeholder="Phone Number">
                        <label for="phonenumber-contact">Phone Number</label>
                    </div>
                    <div class="form-feedback-item">
                        <textarea wire:model="message" name="message-contact" id="message-contact" class="w-100" cols="40" maxlength="400" required placeholder="Message"></textarea>
                        <label for="message-contact">Message</label>
                    </div>
                    <button type="submit" class="btn-feedback" wire:loading.attr="disabled">
                        <div wire:loading.class="d-none" class="text-light">SUBMIT NOW</div>
                        <div wire:loading wire:target="feedback" class="text-light">
                            Loading ....
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <iframe class="mapGoogle" src="https://maps.google.com/maps?ll=21.037811,105.809581&q=285 Đội Cấn&t=&z=14&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>
</section>
@endsection