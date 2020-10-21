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
        'title' => 'Platz buchen',
        'intro' => '',
    ],
    'locations' => [
        'title' => 'Standorte',
        'intro' => 'Bitte wählen Sie einen Standort aus.',
    ],
    'time_grid' => [
        'intro' => 'Sie können bis zu :user_booking_quota Termine innerhalb von :display_days_in_advance Öffnungstagen im Voraus reservieren. Es wird die Anzahl der noch verfügbaren Plätze angezeigt. Die Buchung und Nutzung von Arbeitsplätzen ist im Moment nur für TU- und UdK-Angehörige möglich.',
        'legend' => [
            'title' => 'Legende',
            'available' => 'Verfügbar',
            'user-booked' => 'Von Ihnen gebucht',
            'full' => 'Voll ausgebucht',
            'unavailable' => 'Nicht verfügbar',
        ],
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
        'title' => 'Meine Buchungen',
        'intro' => '',
        'label' => [
            'date' => 'Datum',
            'location' => 'Standort',
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
        'booking_confirmation' => [
            'subject' => 'Terminbestätigung :date, :location',
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
            'advice_library_card' => 'Bitte bringen Sie Ihren Bibliotheksausweis mit (bei TU-Studierenden der Studierendenausweis; bei TU-Beschäftigten der Dienstausweis, wenn als Bibliotheksausweis registriert). Diesen benötigen Sie für den Check-in und Check-out. Ein Einlass ohne Bibliotheksausweis ist nicht möglich.',
            'usage_notes_general_hl' => 'Beachten Sie die folgenden Hinweise zur Nutzung von Arbeitsplätzen',
            'usage_notes_general' => [
                'usage_notes_general_1' => 'Eine Arbeitsplatznutzung ist nur nach vorheriger Anmeldung im Buchungssystem möglich.',
                'usage_notes_general_2' => 'Vor Ort erfolgt über das Ein- und Auschecken eine Anwesenheitsdokumentation nach §3 <a href="https://www.berlin.de/corona/massnahmen/verordnung/" target="_blank">SARS-CoV-2-Infektionsschutzverordnung</a>.',
                'usage_notes_general_3' => 'Bringen Sie Arbeitsmaterialien wie Laptop, Stifte und Papier mit.',
                'usage_notes_general_4' => 'Für den Einlass ins Gebäude ist das Vorzeigen Ihres Bibliotheksausweises (bei TU-Studierenden der Studierendenausweis) erforderlich.',
                'usage_notes_general_5' => 'Aufgrund der Regulierung des Zutritts zum Gebäude kann es zu Wartezeiten kommen. Bitte planen Sie dies ein.',
                'usage_notes_general_6' => 'Das Tragen eines Mund-Nasen-Schutzes ist verpflichtend, auch am Arbeitsplatz. Beachten Sie die aktuellen Hinweise auf den Webseiten der Bibliothek unter <a href="https://www.ub.tu-berlin.de/aktuelles/coronafaq/#c55102">https://www.ub.tu-berlin.de/aktuelles/coronafaq/#c55102</a>.',
                'usage_notes_general_7' => 'Ihre Reservierung gilt jeweils für den gesamten gebuchten Zeitraum. Sie verfällt nicht automatisch, wenn Sie sich erst im Laufe des Tages oder gar nicht einchecken. Stornieren Sie daher Ihre Buchung, falls Sie den Termin nicht wahrnehmen können, damit andere die Chance haben, den Platz zu buchen.',
            ],
            'usage_notes_in_practice_hl' => 'Vor Ort',
            'pre_check_in' => 'Sie können bereits :allowed_minutes_for_pre_check_in Minuten vor Ihrem gebuchten Termin einchecken.',
            'usage_notes_in_practice' => [
                'zb' => [
                    'usage_notes_in_practice_1' => 'Nach dem Betreten des Gebäudes loggen Sie sich am Check-in-Schalter mit Ihrem Bibliotheksausweis ein.',
                    'usage_notes_in_practice_2' => 'Nehmen Sie sich einen Korb in der zugewiesenen Etagenfarbe und begeben sich auf direktem Weg zu der Etage, auf der Ihr Sitzplatz gebucht ist. Auf der gebuchten Etage haben Sie freie Sitzplatzwahl.',
                    'usage_notes_in_practice_3' => 'Wenn Sie sich im Gebäude bewegen oder eine Pause machen, führen Sie Ihren Korb bitte immer mit sich.',
                    'usage_notes_in_practice_4' => 'Ihren Arbeitsplatz reinigen Sie vor und nach der Benutzung mit den bereitgestellten Reinigungsmaterialien.',
                    'usage_notes_in_practice_5' => 'Achten Sie darauf, ausreichend Sicherheitsabstand zu anderen Personen zu halten.',
                    'usage_notes_in_practice_6' => 'Sanitäranlagen stehen nur zur Einzelnutzung zur Verfügung. Desinfektionsmöglichkeiten werden bereitgestellt.',
                    'usage_notes_in_practice_7' => 'Beim endgültigen Verlassen des Gebäudes loggen Sie sich am Check-out-Schalter mit Ihrem Bibliotheksausweis aus und stellen den Korb zurück.',
                    'usage_notes_in_practice_8' => 'Auch wenn Sie im Anschluss einen weiteren Zeitraum gebucht haben, räumen Sie bitte Ihren Arbeitsplatz, loggen Sie sich aus, stellen den Korb zurück und verlassen das Gebäude. Zu Beginn des neuen Zeitraum loggen Sie sich erneut ein.',
                ],
                'mathe' => [
                    'usage_notes_in_practice_1' => 'Nach dem Betreten des Mathematik-Gebäudes zeigen Sie bitte die Buchungsbestätigung ausgedruckt oder auf Ihrem Smartphone an der Pförtnerloge vor.',
                    'usage_notes_in_practice_2' => 'Nach Prüfung durch das Aufsichtspersonal begeben Sie sich bitte auf direktem Wege in die 1. Etage zur Bibliothek (Raum MA 163).',
                    'usage_notes_in_practice_3' => 'Sie werden dort vom Bibliotheksteam empfangen und eingecheckt.',
                ],
                'dbwm' => [
                    'usage_notes_in_practice_1' => 'Zum Betreten des Hauptgebäudes zeigen Sie bitte die Buchungsbestätigung ausgedruckt oder auf Ihrem Smartphone an der Pförtnerloge vor.',
                    'usage_notes_in_practice_2' => 'Nach Prüfung durch das Aufsichtspersonal begeben Sie sich bitte auf direktem Wege in die 5. Etage zur Bibliothek.',
                    'usage_notes_in_practice_3' => 'Bitte beachten Sie, dass die Fahrstühle nur einzeln genutzt werden können und dass im gesamten Hauptgebäude Maskenpflicht besteht. Sonstige Aufenthalte z.B. Pausen sind im Hauptgebäude nicht gestattet.',
                    'usage_notes_in_practice_4' => 'Sie werden vor Ort in der Bibliothek vom Bibliotheksteam empfangen und eingecheckt.',
                    'usage_notes_in_practice_5' => 'Wenn Sie eine Pause machen und die Bibliothek sowie das Hauptgebäude verlassen, führen Sie Ihren Korb oder den farbigen Einleger bitte immer mit sich. Ihr Platz bleibt reserviert - lassen Sie Pausenkarte und ggf. Korb an dem von Ihnen genutzten Arbeitsplatz stehen.',
                    'usage_notes_in_practice_6' => 'Wenn Ihr Bibliotheksaufenthalt für den Tag beendet ist, wenden Sie sich an das Bibliotheksteam zum Auschecken und geben Ihren Korb zurück. Ihr Platz wird wieder frei.',
                    'usage_notes_in_practice_7' => 'Bitte verlassen Sie auf direktem Weg die Bibliothek und das Hauptgebäude.',
                ],
                'bbphysik' => [
                    'usage_notes_in_practice_1' => 'Betreten Sie das Gebäude durch den Haupteingang und zeigen Sie an der Pförtnerloge dieses Bestätigungsschreiben (digital oder ausgedruckt) und Ihren Bibliotheksausweis (für TU-Studierende gilt der Studierendenausweis als Bibliotheksausweis) vor, damit Sie Einlass erhalten.',
                    'usage_notes_in_practice_2' => '<a href="https://www.ub.tu-berlin.de/bibliothek-benutzen/standorte-und-oeffnungszeiten/wegbeschreibung-zur-bb-physik/">So kommen Sie am besten zur Bereichsbibliothek</a>',
                    'usage_notes_in_practice_3' => 'In der Bibliothek nehmen Sie sich bitte einen Korb und reinigen ihn mit den bereitgestellten Reinigungsmaterialien.',
                    'usage_notes_in_practice_4' => 'Kommen Sie mit Ihrem Bibliotheksausweis zur Ausleihtheke und lassen Sie sich einchecken.',
                    'usage_notes_in_practice_5' => 'Sie haben freie Platzwahl.',
                    'usage_notes_in_practice_6' => 'Ihren Arbeitsplatz reinigen Sie vor und nach der Benutzung mit den bereitgestellten Reinigungsmaterialien.',
                    'usage_notes_in_practice_7' => 'Achten Sie darauf, ausreichend Sicherheitsabstand zu anderen Personen zu halten.',
                    'usage_notes_in_practice_8' => 'Sanitäranlagen stehen auf der Etage außerhalb der Bibliothek zur Verfügung.',
                    'usage_notes_in_practice_9' => 'Desinfektionsmittel werden bereitgestellt.',
                    'usage_notes_in_practice_10' => 'Führen Sie Ihren Korb stets mit sich, auch wenn Sie eine Pause machen und die Bibliothek verlassen.',
                    'usage_notes_in_practice_11' => 'Beim endgültigen Verlassen der Bibliothek kommen Sie bitte an die Ausleihtheke mit ihrem Bibliotheksausweis zum Check-out und stellen Sie Ihren Korb zurück.',
                ],
                'bbarch' => [
                    'usage_notes_in_practice_1' => 'Betreten Sie das Gebäude durch den Haupteingang (Gebäude A, Hochhaus) und zeigen Sie an der Pförtnerloge dieses Bestätigungsschreiben (digital oder ausgedruckt) und Ihren Bibliotheksausweis (für TU-Studierende gilt der Studierendenausweis als Bibliotheksausweis) vor, damit Sie Einlass erhalten.',
                    'usage_notes_in_practice_2' => 'In der Bibliothek nehmen Sie sich bitte einen Korb und reinigen ihn mit den bereitgestellten Reinigungsmaterialien.',
                    'usage_notes_in_practice_3' => 'Kommen Sie mit Ihrem Bibliotheksausweis zur Ausleihtheke und lassen Sie sich einchecken.',
                    'usage_notes_in_practice_4' => 'Sie haben freie Platzwahl.',
                    'usage_notes_in_practice_5' => 'Ihren Arbeitsplatz reinigen Sie vor und nach der Benutzung mit den bereitgestellten Reinigungsmaterialien.',
                    'usage_notes_in_practice_6' => 'Achten Sie darauf, ausreichend Sicherheitsabstand zu anderen Personen zu halten.',
                    'usage_notes_in_practice_7' => 'Sanitäranlagen stehen auf der Etage außerhalb der Bibliothek zur Verfügung.',
                    'usage_notes_in_practice_8' => 'Desinfektionsmittel werden bereitgestellt.',
                    'usage_notes_in_practice_9' => 'Führen Sie Ihren Korb stets mit sich, auch wenn Sie eine Pause machen und die Bibliothek verlassen.',
                    'usage_notes_in_practice_10' => 'Beim endgültigen Verlassen der Bibliothek kommen Sie bitte an die Ausleihtheke mit ihrem Bibliotheksausweis zum Check-out und stellen Sie Ihren Korb zurück.',
                ],
            ],
        ],
        'daily_stats' => [
            'subject' => 'Tagesstatistik Buchungssystem :location :date',
            'goodbye' => 'Bis morgen!',
            'bookings' => 'Buchungen',
            'check_ins' => 'Check-Ins',
            'check_outs' => 'Check-Outs',
            'bookings_with_check_in' => 'Buchungen mit Check-In',
            'check_ins_with_check_out' => 'Check-Ins mit Check-Out',
            'total_users' => 'Anzahl Gesamtkunden im System',
            'total_logins' => 'Anzahl Logins im System',
        ],
    ],
    'checkin' => [
        'title' => 'Check-In',
        'text_1' => 'Bitte scannen Sie Ihren Bibliotheksausweis ein.',
        'text_2' => 'Mit dem Einscannen des Bibliotheksausweises bestätigen Sie, dass Sie sich gesund fühlen. Wenn Sie Erkältungssymptome haben (z.B. Fieber oder Husten), dürfen Sie die Universitätsbibliothek nicht betreten.',
        'pre_check_in' => 'Sie können an diesem Standort bereits :allowed_minutes_for_pre_check_in Minuten vor Ihrem gebuchten Termin einchecken.',
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
    'admin' => [
        'title' => 'Administration Buchungssystem für Arbeitsplätze',
        'intro' => 'Hier können Einstellungen vorgenommen werden.',
        'locations' => [
            'title' => 'Standorte',
            'description' => 'Hier können Standorte, Ressourcen, Zeitslots und Schließzeiten verwaltet werden.',
            'label' => [
                'uid' => 'UID',
                'name' => 'Name',
                'address' => 'Adresse',
                'email' => 'E-Mail',
                'logo' => 'Logo',
                'image' => 'Teaser',
                'coordinates' => 'Koordinaten',
                'days_in_advance' => 'Tage',
                'user_booking_quota' => 'Limit',
                'actions' => 'Aktionen',
            ],
            'form' => [
                'new' => [
                    'title' => 'Neuen Standort eintragen'
                ],
                'edit' => [
                    'title' => 'Standorte ändern'
                ],
                'delete' => [
                    'message' => 'Wirklich löschen?',
                ],
                'fields' => [
                    'uid' => [
                        'label' => 'UID'
                    ],
                    'name' => [
                        'label' => 'Name'
                    ],
                    'address' => [
                        'label' => 'Adresse'
                    ],
                    'email' => [
                        'label' => 'E-Mail'
                    ],
                    'logo_uri' => [
                        'label' => 'Logo URI'
                    ],
                    'image_uri' => [
                        'label' => 'Teaserbild URI'
                    ],
                    'latitude' => [
                        'label' => 'Breitengrad'
                    ],
                    'longitude' => [
                        'label' => 'Längengrad'
                    ],
                    'display_days_in_advance' => [
                        'label' => 'Buchbare Tage im Voraus'
                    ],
                    'user_booking_quota' => [
                        'label' => 'Buchungslimit je User'
                    ],
                    'allowed_minutes_for_pre_check_in' => [
                        'label' => 'Erlaube Vorab-Check-In in Minuten'
                    ],
                    'is_pre_check_in_displayed' => [
                        'label' => 'Anzeige der Möglichkeit eines Vorab-Check-Ins in Bestätigungs-E-Mail und auf Check-In-Seite',
                        'value' => 'Anzeigen',
                    ],
                    'seconds_until_check_in_refresh' => [
                        'label' => 'Dauer der Statusanzeige beim Check-In'
                    ],
                    'seconds_until_check_out_refresh' => [
                        'label' => 'Dauer der Statusanzeige beim Check-Out'
                    ],
                ],
                'submit_value' => 'Speichern',
                'submit_progress_value' => 'Speichere ...',
                'cancel_value' => 'Abbrechen',
                'cancel_message' => 'Wirklich abbrechen?',
            ],
            'action' => [
                'new' => 'Neu',
                'edit' => 'Ändern',
                'delete' => 'Löschen',
                'resources' => 'Ressourcen',
                'closings' => 'Schließzeiten',
                'admin_index' => 'Admin-Übersicht',
            ],
        ],
        'resources' => [
            'title' => 'Ressourcen',
            'description' => 'Hier können Standorte, Ressourcen, Zeitslots und Schließzeiten verwaltet werden.',
            'label' => [
                'name' => 'Name',
                'short_name' => 'Kurzname',
                'location' => 'Standort',
                'capacity' => 'Kapazität',
                'time_slots' => 'Slots',
                'actions' => 'Aktionen',
            ],
            'form' => [
                'new' => [
                    'title' => 'Neue Ressource eintragen'
                ],
                'edit' => [
                    'title' => 'Ressource ändern'
                ],
                'delete' => [
                    'message' => 'Wirklich löschen?',
                ],
                'fields' => [
                    'name' => [
                        'label' => 'Name'
                    ],
                    'short_name' => [
                        'label' => 'Kurzname'
                    ],
                    'location' => [
                        'label' => 'Standort'
                    ],
                    'capacity' => [
                        'label' => 'Kapazität'
                    ],
                    'color' => [
                        'label' => 'Farbe'
                    ],
                    'text_color' => [
                        'label' => 'Dazu passende Textfarbe'
                    ],
                ],
                'submit_value' => 'Speichern',
                'submit_progress_value' => 'Speichere ...',
                'cancel_value' => 'Abbrechen',
                'cancel_message' => 'Wirklich abbrechen?',
            ],
            'action' => [
                'new' => 'Neu',
                'edit' => 'Ändern',
                'delete' => 'Löschen',
                'location_index' => 'Standorte',
                'time_slot_index' => 'Slots',
            ],
        ],
        'time_slots' => [
            'title' => 'Slots',
            'description' => 'Hier können Standorte, Ressourcen, Zeitslots und Schließzeiten verwaltet werden.',
            'label' => [
                'week_day' => 'Wochentag',
                'start' => 'Beginn',
                'end' => 'Ende',
                'date_start' => 'Von',
                'date_end' => 'Bis',
                'actions' => 'Aktionen',
            ],
            'form' => [
                'new' => [
                    'title' => 'Neuen Slot anlegen',
                ],
                'edit' => [
                    'title' => 'Slot ändern',
                ],
                'delete' => [
                    'message' => 'Wirklich löschen?',
                ],
                'fields' => [
                    'week_day' => [
                        'label' => 'Wochentag'
                    ],
                    'start' => [
                        'label' => 'Startzeit'
                    ],
                    'end' => [
                        'label' => 'Endzeit'
                    ],
                    'date_from' => [
                        'label' => 'Gültig ab (optional)'
                    ],
                    'date_to' => [
                        'label' => 'Gültig bis (optional)'
                    ],
                ],
                'submit_value' => 'Speichern',
                'submit_progress_value' => 'Speichere ...',
                'cancel_value' => 'Abbrechen',
                'cancel_message' => 'Wirklich abbrechen?',
            ],
            'action' => [
                'new' => 'Neu',
                'edit' => 'Ändern',
                'delete' => 'Löschen',
                'resource_index' => 'Ressourcen',
            ],
        ],
        'bookings' => [
            'title' => 'Buchungen',
            'description' => 'Hier können durch Eingabe eines Barcodes die Buchungen einer Person geprüft werden.',
            'form' => [
                'index' => [
                    'barcode' => [
                        'label' => 'Barcode',
                        'placeholder' => 'Barcode'
                    ],
                    'submit_value' => 'Buchungen suchen',
                    'submit_progress_value' => 'Suche Buchungen ...',
                ]
            ],
            'label' => [
                'date' => 'Datum',
                'location' => 'Standort',
                'resource' => 'Ort',
                'start' => 'Beginn',
                'end' => 'Ende',
                'status_active' => 'Aktiv',
                'status_deleted_by_user' => 'Userlöschung',
                'status_check_in' => 'Check-In',
                'status_check_out' => 'Check-Out',
            ],
            'status' => [
                'active' => 'Aktiv',
                'expired' => 'Abgelaufen',
                'deleted_by_user' => 'Manuelle Löschung am :date um :time Uhr',
                'checked_in' => 'Check-In vorhanden',
                'not_checked_in' => 'kein Check-In vorhanden',
                'checked_out' => 'Check-Out vorhanden',
            ]
        ],
        'closings' => [
            'title' => 'Schließzeiten',
            'description' => 'Hier können Schließzeiten für Standorte eingetragen werden.',
            'form' => [
                'new' => [
                    'title' => 'Neue Schließzeit eintragen',
                ],
                'edit' => [
                    'title' => 'Schließzeit ändern',
                ],
                'delete' => [
                    'message' => 'Wirklich löschen?',
                ],
                'fields' => [
                    'date_start' => [
                        'label' => 'Von'
                    ],
                    'date_end' => [
                        'label' => 'Bis (optional)'
                    ],
                    'description' => [
                        'label' => 'Beschreibung'
                    ],
                ],
                'submit_value' => 'Speichern',
                'submit_progress_value' => 'Speichere ...',
                'cancel_value' => 'Abbrechen',
                'cancel_message' => 'Wirklich abbrechen?',
            ],
            'label' => [
                'date_start' => 'Von',
                'date_end' => 'Bis',
                'description' => 'Beschreibung',
                'actions' => 'Aktionen',
            ],
            'action' => [
                'new' => 'Neu',
                'edit' => 'Ändern',
                'delete' => 'Löschen',
                'location_index' => 'Standortübersicht',
            ],
            'status' => [

            ]
        ],
        'permissions' => [
            'title' => 'Admin-Berechtigungen',
            'description' => 'Hier können Sie Admin-Berechtigungen vergeben.',
            'label' => [
                'username' => 'Benutzername',
                'barcode' => 'Barcode',
                'actions' => 'Aktionen',
            ],
            'action' => [
                'new' => 'Neu',
                'delete' => 'Löschen',
            ],
            'form' => [
                'index' => [
                    'barcode' => [
                        'label' => 'Barcode',
                        'placeholder' => 'Barcode'
                    ],
                    'submit_value' => 'Berechtigung hinzufügen',
                    'submit_progress_value' => 'Füge Berechtigung hinzu ...',
                ]
            ],
            'status' => [

            ]
        ],
        'statistics' => [
            'title' => 'Statistiken',
            'description' => 'Hier können Sie verschiedene Statistiken einsehen.',
            'occupancies' => [
                'title' => 'Auslastung',
                'description' => 'Hier können Sie die Auslastung für die verschiedenen Standorte abrufen.',
                'label' => [
                    'location' => 'Standort',
                    'bookings' => 'Buchungen',
                    'check_ins' => 'Check-Ins',
                    'occupancy_rate' => 'Auslastung',
                ],
            ]
        ],
    ],
];
