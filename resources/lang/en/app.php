<?php

return [
    'main' => [
        'title' => 'Booking System for Library Study Places',
        'owner' => 'Universitätsbibliotheken der TU Berlin und UdK Berlin',
        'user' => [
            'login_as' => 'Logged in as',
            'phone' => 'Phone number',
            'number_of_bookings' => 'Number of bookings'
        ]
    ],
    'home' => [
        'title' => 'Welcome!',
        'intro' => '',
    ],
    'time_grid' => [
        'intro' => 'You can reserve up to 5 dates during the next 14 days',
        'legend' => 'Legend',
        'pagination' => [
            'previous' => 'Previous',
            'now' => 'Now',
            'next' => 'Next',
        ],
        'form' => [
            'create' => [
                'title' => 'Are You Sure?',
                'text' => 'You are now creating a reservation.',
                'submit_value' => 'Create a reservation.',
                'cancel_value' => 'Cancel',
            ]
        ],
        'status' => [
            'create_success' => [
                'text' => 'Your reservation was successful. A confirmation email was sent to :email',
            ],
            'create_failure' => [
                'text_time_slot_is_over' => 'This time slot is already over.',
                'text_time_slot_already_booked' => 'This time slot is already booked by you.',
                'text_quota_exhausted' => 'You have reached the limit of :user_booking_quota and can therefore not create new bookings',
            ],
        ],
    ],
    'bookings' => [
        'title' => 'Your Reservations',
        'intro' => '',
        'action' => [
            'resend' => 'Resend confirmation',
            'delete' => 'Delete',
        ],
        'form' => [
            'delete' => [
                'title' => 'Are you sure?',
                'text' => 'You are about to delete a reservation.',
                'submit_value' => 'Delete reservation',
                'cancel_value' => 'Cancel',
            ]
        ],
        'status' => [
            'in_progress' => 'Reservation is already in progress',
            'no_bookings' => 'There are no reservations.',
            'delete_success' => 'Reservation has been deleted successfully.',
            'resend_success' => 'Confirmation has been sent successfully.',
        ],
    ],
    'profile' => [
        'title' => 'My Profile',
        'intro' => '',
        'label' => [
            'username' => 'ID',
            'phone' => 'Your phone Number',
        ],
        'action' => [
            'edit_phone' => 'Edit'
        ],
    ],
    'login' => [
        'title' => 'Login',
        'intro' => '',
        'form' => [
            'login' => [
                'username' => [
                    'label' => 'Your login',
                    'placeholder' => '',
                ],
                'password' => [
                    'label' => 'Your password',
                    'placeholder' => 'Your password'
                ],
                'submit_value' => 'Login',
                'submit_progress_value' => 'Authenticating ...',
            ]
        ],
        'status' => [
            'login_success' => 'Login was successful.',
            'login_failure' => 'Login was not successful.',
        ]
    ],
    'logout' => [
        'title' => 'Logout',
        'status' => [
            'logout_success' => 'Logout was successful.',
            'logout_failure' => 'Logout was not successful.',
        ]
    ],
    'auth' => [
        'status' => [
            'auth_failure' => 'An authentication error has occurred.'
        ]
    ],
    'phone' => [
        'form' => [
            'create' => [
                'title' => 'Please Enter Your Phone Number',
                'text' => 'We require this for attendance documentation according to §3 <a class="underline cursor-pointer" href="https://www.berlin.de/corona/en/measures/directive/" target="_blank">SARS-CoV-2 infection protection regulation</a>. It is automatically deleted after four weeks.',
                'submit_value' => 'Add phone number',
                'cancel_value' => 'Cancel',
            ],
            'edit' => [
                'title' => 'Please Enter Your Phone Number',
                'text' => 'We require this for attendance documentation according to §3 <a class="underline cursor-pointer" href="https://www.berlin.de/corona/en/measures/directive/" target="_blank">SARS-CoV-2 infection protection regulation</a>. It is automatically deleted after four weeks.',
                'submit_value' => 'Change phone number',
                'cancel_value' => 'Cancel',
            ]
        ],
        'status' => [
            'create_success' => 'Phone number was successfully registered.',
            'create_failure' => 'Phone number could not be registered.',
            'edit_success' => 'Phone number was successfully changed.',
            'edit_failure' => 'Phone number could not be changed.',
        ],
    ],
    'mail' => [
        'subject' => 'Date confirmation',
        'title' => 'Date Confirmation',
        'hello' => '',
        'goodbye' => 'Thank you!',
        'intro' => 'We hereby confirm your date for study place use.',
        'address' => 'Address',
        'resource' => 'Location',
        'user_barcode' => 'Library card number',
        'date' => 'Date',
        'time' => 'Time',
        'time_value' => ':booking_start - :booking_end ',
        'advice_library_card' => 'Please bring your library card with you (for TU students the student card is valid as library card). You will need it for check-in and check-out. Admission without library card is not possible.',
        'usage_notes_general_hl' => 'Please note the following notes on the use of study places',
        'usage_notes_general' => [
            'usage_notes_general_1' => 'Use of a library study place is only possible after prior registration in the booking system.',
            'usage_notes_general_2' => 'Reservation dates are available for the following periods: Monday to Friday from 10:00 to 16:00.',
            'usage_notes_general_3' => 'On site an attendance documentation according to §3 <a href="https://www.berlin.de/corona/en/measures/directive/" target="_blank">SARS-CoV-2 infection protection regulation</a> is carried out by checking in and out.',
            'usage_notes_general_4' => 'Please bring your own equipment and materials like laptop, pens and paper.',
            'usage_notes_general_5' => 'To enter the building you need to show your library card (for TU students the student card).',
            'usage_notes_general_6' => 'Due to the regulation of access to the building, waiting times may occur. Please plan for this.',
            'usage_notes_general_7' => 'The wearing of a mouth-nose cover is obligatory when you are not sitting at your study place.',
        ],
        'usage_notes_in_practice_hl' => 'On site',
        'usage_notes_in_practice' => [
            'usage_notes_in_practice_1' => 'After entering the building you log in at the check-in counter with your library card (for TU students the student card).',
            'usage_notes_in_practice_2' => 'Please take a basket in the assigned floor colour and proceed directly to the floor on which your seat is booked. You have free choice of seating on the floor you have booked.',
            'usage_notes_in_practice_3' => 'If you move around the building or take a break, please always carry your basket with you.',
            'usage_notes_in_practice_4' => 'Please clean your study place before and after use with the cleaning materials provided.',
            'usage_notes_in_practice_5' => 'Please make sure to observe a sufficient physical distance (at least 2 metres) to others.',
            'usage_notes_in_practice_6' => 'Sanitary facilities may be only used by one person at a time. Disinfectants are provided.',
            'usage_notes_in_practice_7' => 'When you leave the building, log out at the check-out counter with your library card and return the basket back.',
        ],
    ],
    'checkin' => [
        'title' => 'Check-In',
        'text_1' => 'Please scan you library card.',
        'text_2' => 'By scanning your library card you confirm that you are healthy. If you have symptoms of a cold (e.g. fever or cough), you are not allowed to enter the University Library.',
        'form' => [
            'checkin' => [
                'barcode' => [
                    'placeholder' => '1690 ...',
                ],
            ]
        ],
        'status' => [
            'checkin_success' => [
                'title' => 'Check-In Successful',
                'text' => 'Please take a basket <span style="color: :resource_color">Korb</span> and go directly to :resource_name.',
            ],
            'checkin_failure' => [
                'title' => 'Check-In Not Successful',
                'text_active_checkin_present' => 'You are checked in already.',
                'text_no_booking_present' => 'No reservation present. Please book a study place online.',
            ],
        ],
    ],
    'checkout' => [
        'title' => 'Check-Out',
        'text_1' => 'Please scan your library card.',
        'form' => [
            'checkout' => [
                'barcode' => [
                    'placeholder' => '1690 ...',
                ],
            ]
        ],
        'status' => [
            'checkout_success' => [
                'title' => 'Good Bye',
                'text' => 'Please return your basket.',
            ],
            'checkout_failure' => [
                'title' => 'Check-Out not possible',
                'text' => 'Please contact the library staff.',
            ]
        ],
    ],
];
