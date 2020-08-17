<?php

return [
    'main' => [
        'title' => 'Buchungssystem für Arbeitsplätze',
        'owner' => 'Universitätsbibliotheken der TU Berlin und UdK Berlin',
        'user' => [
            'login_as' => 'Eingeloggt als',
            'phone' => 'Telefonnummer',
            'number_of_bookings' => '# Buchungen'
        ]
    ],
    'home' => [
        'title' => 'Willkommen!',
        'intro' => '',
    ],
    'time_grid' => [
        'intro' => 'Sie können bis zu :user_booking_quota Termine innerhalb der folgenden :display_days_in_advance Öffnungstage reservieren. Es wird die Anzahl der noch verfügbaren Plätze angezeigt. Die Buchung und Nutzung von Arbeitsplätzen ist im Moment nur für TU- und UdK-Angehörige möglich.',
        'legend' => 'Legende',
        'pagination' => [
            'previous' => 'Früher',
            'now' => 'Jetzt',
            'next' => 'Später',
        ],
        'form' => [
            'create' => [
                'title' => 'Sind Sie sicher?',
                'text' => 'Sie sind dabei eine Buchung anzulegen.',
                'submit_value' => 'Buchung anlegen',
                'cancel_value' => 'Abbrechen',
            ]
        ],
        'status' => [
            'create_success' => [
                'text' => 'Buchung wurde erfolgreich angelegt. Eine Bestätigungs-E-Mail wurde an :email versandt.',
            ],
            'create_failure' => [
                'text_time_slot_is_over' => 'Dieser Slot ist bereits vorbei.',
                'text_time_slot_is_full' => 'Dieser Slot ist bereits vollständig belegt.',
                'text_time_slot_already_booked' => 'Sie haben bereits eine Buchung um diese Zeit.',
                'text_quota_exhausted' => 'Sie haben das Limit von :user_booking_quota erreicht und können deshalb keine neuen Buchungen anlegen. Ein möglicher Grund: Sie sind noch in der Bibliothek oder haben Sie gerade verlassen, aber nicht ausgecheckt. Dadurch zählt diese Buchung noch als aktiv. Eine Buchung für :user_booking_quota weitere Tage können Sie erst nach dem Check-out durchführen bzw. erst am folgenden Tag, sollten Sie das Checkout vergessen haben.',
            ],
        ],
    ],
    'bookings' => [
        'title' => 'Buchungsübersicht',
        'intro' => '',
        'label' => [
            'date' => 'Datum',
            'resource' => 'Ort',
            'start' => 'Beginn',
            'end' => 'Ende'
        ],
        'action' => [
            'resend' => 'Bestätigung erneut senden',
            'delete' => 'Entfernen',
        ],
        'form' => [
            'delete' => [
                'title' => 'Sind Sie sicher?',
                'text' => 'Sie sind dabei eine Buchung zu löschen.',
                'submit_value' => 'Buchung löschen',
                'cancel_value' => 'Abbrechen',
            ]
        ],
        'status' => [
            'in_progress' => 'Buchung läuft bereits',
            'no_bookings' => 'Keine Buchungen vorhanden.',
            'delete_success' => 'Buchung wurde erfolgreich gelöscht.',
            'resend_success' => 'Bestätigung wurde erfolgreich gesendet.',
        ],
    ],
    'profile' => [
        'title' => 'Mein Profil',
        'intro' => '',
        'label' => [
            'username' => 'Ihr Barcode',
            'phone' => 'Ihre Telefonnummer',
        ],
        'action' => [
            'edit_phone' => 'Ändern'
        ],
    ],
    'login' => [
        'title' => 'Anmelden',
        'intro' => '',
        'form' => [
            'login' => [
                'username' => [
                    'label' => 'Ihr Login',
                    'hint_tu' => 'TU-Studierende: Name des TUB-Accounts',
                    'hint_udk' => 'TU-Personal und UdK-Angehörige: Bibliotheksausweisnummer',
                    'placeholder' => '',
                ],
                'password' => [
                    'label' => 'Ihr Passwort',
                    'hint_tu' => 'TU-Studierende: Passwort des TUB-Accounts',
                    'hint_udk' => 'TU-Personal und UdK-Angehörige: Passwort des Bibliotheksausweises (voreingestellt: 1. Buchstabe des Nachnamens (als Großbuchstabe) plus Geburtsdatum (in der Form: TTMMJJ) plus # (Beispiel: Eva Mustermann  M110891#)',
                    'placeholder' => ''
                ],
                'submit_value' => 'Anmelden',
                'submit_progress_value' => 'Authentifizierung ...',
            ]
        ],
        'status' => [
            'login_success' => 'Anmeldung war erfolgreich.',
            'login_failure' => 'Anmeldung war nicht erfolgreich.',
        ]
    ],
    'logout' => [
        'title' => 'Abmelden',
        'status' => [
            'logout_success' => 'Abmeldung war erfolgreich.',
            'logout_failure' => 'Abmeldung war nicht erfolgreich.',
            'logout_no_phone' => 'Abmeldung wegen fehlender Telefonnummer.',
        ]
    ],
    'auth' => [
        'status' => [
            'session_expired' => 'Ihre Session ist abgelaufen. Bitte melden Sie sich erneut an.',
            'auth_failure' => 'Authentifizierungsfehler: :error_message'
        ]
    ],
    'phone' => [
        'form' => [
            'create' => [
                'title' => 'Bitte geben Sie Ihre Telefonnummer ein',
                'text' => 'Diese benötigen wir zur Anwesenheitsdokumentation nach §3 <a class="underline cursor-pointer" href="https://www.berlin.de/corona/massnahmen/verordnung/" target="_blank">SARS-CoV-2-Infektionsschutzverordnung</a>. Sie wird nach Ablauf von vier Wochen automatisch gelöscht.',
                'submit_value' => 'Telefonnummer hinzufügen',
                'cancel_value' => 'Abbrechen',
            ],
            'edit' => [
                'title' => 'Bitte geben Sie Ihre Telefonnummer ein',
                'text' => 'Diese benötigen wir zur Anwesenheitsdokumentation nach §3 <a class="underline cursor-pointer" href="https://www.berlin.de/corona/massnahmen/verordnung/" target="_blank">SARS-CoV-2-Infektionsschutzverordnung</a>. Sie wird nach Ablauf von vier Wochen automatisch gelöscht.',
                'submit_value' => 'Telefonnummer ändern',
                'cancel_value' => 'Abbrechen',
            ]
        ],
        'status' => [
            'create_success' => 'Telefonnummer wurde erfolgreich erfasst.',
            'create_failure' => 'Telefonnummer konnte nicht erfasst werden.',
            'edit_success' => 'Telefonnummer wurde erfolgreich geändert.',
            'edit_failure' => 'Telefonnummer konnte nicht geändert werden.',
        ],
    ],
    'mail' => [
        'subject' => 'Terminbestätigung',
        'title' => 'Terminbestätigung',
        'hello' => '',
        'goodbye' => 'Vielen Dank!',
        'intro' => 'Hiermit bestätigen wir Ihren Termin zur Arbeitsplatznutzung.',
        'address' => 'Adresse',
        'resource' => 'Ort',
        'user_barcode' => 'Bibliotheksausweisnummer',
        'date' => 'Datum',
        'time' => 'Uhrzeit',
        'time_value' => ':booking_start - :booking_end Uhr',
        'advice_library_card' => 'Bitte bringen Sie Ihren Bibliotheksausweis mit (für TU-Studierende gilt der Studierendenausweis als Bibliotheksausweis). Diesen benötigen Sie für den Check-in und Check-out. Ein Einlass ohne Bibliotheksausweis ist nicht möglich.',
        'usage_notes_general_hl' => 'Bitte beachten Sie die folgenden Hinweise zur Nutzung von Arbeitsplätzen',
        'usage_notes_general' => [
            'usage_notes_general_1' => 'Eine Arbeitsplatznutzung ist nur nach vorheriger Anmeldung im Buchungssystem möglich.',
            'usage_notes_general_2' => 'Es stehen Termine für den folgenden Zeitraum zur Verfügung: Montag bis Freitag von 10-16 Uhr.',
            'usage_notes_general_3' => 'Vor Ort erfolgt über das Ein- und Auschecken eine Anwesenheitsdokumentation nach §3 <a href="https://www.berlin.de/corona/massnahmen/verordnung/" target="_blank">SARS-CoV-2-Infektionsschutzverordnung</a>.',
            'usage_notes_general_4' => 'Bitte bringen Sie Arbeitsmaterialien wie Laptop, Stifte und Papier mit.',
            'usage_notes_general_5' => 'Für den Einlass ins Gebäude ist das Vorzeigen Ihres Bibliotheksausweises (bei TU-Studierenden der Studierendenausweis) erforderlich.',
            'usage_notes_general_6' => 'Aufgrund der Regulierung des Zutritts zum Gebäude kann es zu Wartezeiten kommen. Bitte planen Sie dies ein.',
            'usage_notes_general_7' => 'Das Tragen eines Mund-Nasen-Schutz ist verpflichtend, soweit sie sich nicht auf ihrem Sitzplatz aufhalten.',
            'usage_notes_general_8' => 'Ihre Reservierung gilt jeweils für den gesamten gebuchten Zeitraum. Sie verfällt nicht automatisch, wenn Sie sich erst im Laufe des Tages oder gar nicht einchecken. Stornieren Sie daher bitte Ihre Buchung, falls Sie den Termin nicht wahrnehmen können.',
        ],
        'usage_notes_in_practice_zb_hl' => 'Vor Ort (Universitätsbibliotheken, Fasanenstr. 88)',
        'usage_notes_in_practice_zb' => [
            'usage_notes_in_practice_1' => 'Nach dem Betreten des Gebäudes loggen Sie sich am Check-in-Schalter mit Ihrem Bibliotheksausweis (bei TU-Studierenden der Studierendenausweis) ein.',
            'usage_notes_in_practice_2' => 'Bitte nehmen Sie sich einen Korb in der zugewiesenen Etagenfarbe und begeben sich auf direktem Weg zu der Etage, auf der Ihr Sitzplatz gebucht ist. Auf der gebuchten Etage haben Sie freie Sitzplatzwahl.',
            'usage_notes_in_practice_3' => 'Wenn Sie sich im Gebäude bewegen oder eine Pause machen, führen Sie Ihren Korb bitte immer mit sich.',
            'usage_notes_in_practice_4' => 'Ihren Arbeitsplatz reinigen Sie vor und nach der Benutzung mit den bereitgestellten Reinigungsmaterialien.',
            'usage_notes_in_practice_5' => 'Bitte achten Sie darauf, ausreichend Sicherheitsabstand zu anderen Personen zu halten.',
            'usage_notes_in_practice_6' => 'Sanitäranlagen stehen nur zur Einzelnutzung zur Verfügung. Desinfektionsmöglichkeiten werden bereitgestellt.',
            'usage_notes_in_practice_7' => 'Beim Verlassen des Gebäudes loggen Sie sich am Check-out-Schalter mit Ihrem Bibliotheksausweis aus und stellen den Korb zurück.',
        ],
        'usage_notes_in_practice_mathebib_hl' => 'Vor Ort (Mathematische Fachbibliothek)',
        'usage_notes_in_practice_mathebib' => [
            'usage_notes_in_practice_1' => 'Nach dem Betreten des Mathematik-Gebäudes zeigen Sie bitte die Buchungsbestätigung ausgedruckt oder auf Ihrem Smartphone an der Pförtnerloge vor.',
            'usage_notes_in_practice_2' => 'Nach Prüfung durch das Aufsichtspersonal begeben Sie sich bitte auf direktem Wege in die 1. Etage zur Bibliothek (Raum MA 163).',
            'usage_notes_in_practice_3' => 'Sie werden dort vom Bibliotheksteam empfangen und eingecheckt.',
        ],
    ],
    'checkin' => [
        'title' => 'Check-In',
        'text_1' => 'Bitte scannen Sie Ihren Bibliotheksausweis ein.',
        'text_2' => 'Mit dem Einscannen des Bibliotheksausweises bestätigen Sie, dass Sie sich gesund fühlen. Wenn Sie Erkältungssymptome haben (z.B. Fieber oder Husten), dürfen Sie die Universitätsbibliothek nicht betreten.',
        'form' => [
            'checkin' => [
                'barcode' => [
                    'placeholder' => '1690 ...',
                ],
            ]
        ],
        'status' => [
            'checkin_success' => [
                'title' => 'Check-In erfolgreich',
                'text' => 'Bitte nehmen Sie einen <span style="color: :resource_color">Korb</span> und gehen direkt zu :resource_name.',
            ],
            'checkin_failure' => [
                'title' => 'Check-In nicht erfolgreich',
                'text_active_checkin_present' => 'Sie sind bereits eingecheckt.',
                'text_no_booking_present' => 'Keine Reservierung vorhanden. Bitte buchen Sie online einen Arbeitsplatz.',
            ],
        ],
    ],
    'checkout' => [
        'title' => 'Check-Out',
        'text_1' => 'Bitte scannen Sie Ihren Bibliotheksausweis ein.',
        'form' => [
            'checkout' => [
                'barcode' => [
                    'placeholder' => '1690 ...',
                ],
            ]
        ],
        'status' => [
            'checkout_success' => [
                'title' => 'Auf Wiedersehen',
                'text' => 'Bitte stellen Sie Ihren Korb zurück.',
            ],
            'checkout_failure' => [
                'title' => 'Checkout nicht möglich',
                'text' => 'Bitte sprechen Sie das UB-Personal an.',
            ]
        ],
    ],
];
