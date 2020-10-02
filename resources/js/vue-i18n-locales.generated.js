export default {
    "de": {
        "app": {
            "main": {
                "title": "Buchungssystem für Arbeitsplätze",
                "owner": "Universitätsbibliotheken der TU Berlin und UdK Berlin",
                "user": {
                    "login_as": "Eingeloggt als",
                    "phone": "Telefonnummer",
                    "number_of_bookings": "# Buchungen"
                }
            },
            "home": {
                "title": "Platz buchen",
                "intro": ""
            },
            "locations": {
                "title": "Standorte",
                "intro": "Bitte wählen Sie einen Standort aus."
            },
            "time_grid": {
                "intro": "Sie können bis zu {user_booking_quota} Termine reservieren. Es wird die Anzahl der noch verfügbaren Plätze angezeigt. Die Buchung und Nutzung von Arbeitsplätzen ist im Moment nur für TU- und UdK-Angehörige möglich.",
                "legend": {
                    "title": "Legende",
                    "available": "Verfügbar",
                    "user-booked": "Von Ihnen gebucht",
                    "full": "Voll ausgebucht",
                    "unavailable": "Nicht verfügbar"
                },
                "pagination": {
                    "previous": "Früher",
                    "now": "Jetzt",
                    "next": "Später"
                },
                "form": {
                    "create": {
                        "title": "Sind Sie sicher?",
                        "text": "Sie sind dabei eine Buchung anzulegen.",
                        "submit_value": "Buchung anlegen",
                        "cancel_value": "Abbrechen"
                    }
                },
                "status": {
                    "create_success": {
                        "text": "Buchung wurde erfolgreich angelegt. Eine Bestätigungs-E-Mail wurde an {email} versandt."
                    },
                    "create_failure": {
                        "text_time_slot_is_over": "Dieser Slot ist bereits vorbei.",
                        "text_time_slot_is_full": "Dieser Slot ist bereits vollständig belegt.",
                        "text_time_slot_already_booked": "Sie haben bereits eine Buchung um diese Zeit.",
                        "text_quota_exhausted": "Sie haben das Limit von {user_booking_quota} erreicht und können deshalb keine neuen Buchungen anlegen. Ein möglicher Grund: Sie sind noch in der Bibliothek oder haben Sie gerade verlassen, aber nicht ausgecheckt. Dadurch zählt diese Buchung noch als aktiv. Eine Buchung für {user_booking_quota} weitere Tage können Sie erst nach dem Check-out durchführen bzw. erst am folgenden Tag, sollten Sie das Checkout vergessen haben."
                    }
                }
            },
            "bookings": {
                "title": "Meine Buchungen",
                "intro": "",
                "label": {
                    "date": "Datum",
                    "location": "Standort",
                    "resource": "Ort",
                    "start": "Beginn",
                    "end": "Ende"
                },
                "action": {
                    "resend": "Bestätigung erneut senden",
                    "delete": "Entfernen"
                },
                "form": {
                    "delete": {
                        "title": "Sind Sie sicher?",
                        "text": "Sie sind dabei eine Buchung zu löschen.",
                        "submit_value": "Buchung löschen",
                        "cancel_value": "Abbrechen"
                    }
                },
                "status": {
                    "in_progress": "Buchung läuft bereits",
                    "no_bookings": "Keine Buchungen vorhanden.",
                    "delete_success": "Buchung wurde erfolgreich gelöscht.",
                    "resend_success": "Bestätigung wurde erfolgreich gesendet."
                }
            },
            "profile": {
                "title": "Mein Profil",
                "intro": "",
                "label": {
                    "username": "Ihr Barcode",
                    "phone": "Ihre Telefonnummer"
                },
                "action": {
                    "edit_phone": "Ändern"
                }
            },
            "login": {
                "title": "Anmelden",
                "intro": "",
                "form": {
                    "login": {
                        "username": {
                            "label": "Ihr Login",
                            "hint_tu": "TU-Studierende: Name des TUB-Accounts",
                            "hint_udk": "TU-Personal und UdK-Angehörige: Bibliotheksausweisnummer",
                            "placeholder": ""
                        },
                        "password": {
                            "label": "Ihr Passwort",
                            "hint_tu": "TU-Studierende: Passwort des TUB-Accounts",
                            "hint_udk": "TU-Personal und UdK-Angehörige: Passwort des Bibliotheksausweises (voreingestellt: 1. Buchstabe des Nachnamens (als Großbuchstabe) plus Geburtsdatum (in der Form: TTMMJJ) plus # (Beispiel: Eva Mustermann  M110891#)",
                            "placeholder": ""
                        },
                        "submit_value": "Anmelden",
                        "submit_progress_value": "Authentifizierung ..."
                    }
                },
                "status": {
                    "login_success": "Anmeldung war erfolgreich.",
                    "login_failure": "Anmeldung war nicht erfolgreich."
                }
            },
            "logout": {
                "title": "Abmelden",
                "status": {
                    "logout_success": "Abmeldung war erfolgreich.",
                    "logout_failure": "Abmeldung war nicht erfolgreich.",
                    "logout_no_phone": "Abmeldung wegen fehlender Telefonnummer."
                }
            },
            "auth": {
                "status": {
                    "session_expired": "Ihre Session ist abgelaufen. Bitte melden Sie sich erneut an.",
                    "auth_failure": "Authentifizierungsfehler: {error_message}"
                }
            },
            "phone": {
                "form": {
                    "create": {
                        "title": "Bitte geben Sie Ihre Telefonnummer ein",
                        "text": "Diese benötigen wir zur Anwesenheitsdokumentation nach §3 <a class=\"underline cursor-pointer\" href=\"https://www.berlin.de/corona/massnahmen/verordnung/\" target=\"_blank\">SARS-CoV-2-Infektionsschutzverordnung</a>. Sie wird nach Ablauf von vier Wochen automatisch gelöscht.",
                        "submit_value": "Telefonnummer hinzufügen",
                        "cancel_value": "Abbrechen"
                    },
                    "edit": {
                        "title": "Bitte geben Sie Ihre Telefonnummer ein",
                        "text": "Diese benötigen wir zur Anwesenheitsdokumentation nach §3 <a class=\"underline cursor-pointer\" href=\"https://www.berlin.de/corona/massnahmen/verordnung/\" target=\"_blank\">SARS-CoV-2-Infektionsschutzverordnung</a>. Sie wird nach Ablauf von vier Wochen automatisch gelöscht.",
                        "submit_value": "Telefonnummer ändern",
                        "cancel_value": "Abbrechen"
                    }
                },
                "status": {
                    "create_success": "Telefonnummer wurde erfolgreich erfasst.",
                    "create_failure": "Telefonnummer konnte nicht erfasst werden.",
                    "edit_success": "Telefonnummer wurde erfolgreich geändert.",
                    "edit_failure": "Telefonnummer konnte nicht geändert werden."
                }
            },
            "mail": {
                "booking_confirmation": {
                    "subject": "Terminbestätigung",
                    "title": "Terminbestätigung",
                    "hello": "",
                    "goodbye": "Vielen Dank!",
                    "intro": "Hiermit bestätigen wir Ihren Termin zur Arbeitsplatznutzung.",
                    "address": "Adresse",
                    "resource": "Ort",
                    "user_barcode": "Bibliotheksausweisnummer",
                    "date": "Datum",
                    "time": "Uhrzeit",
                    "time_value": "{booking_start} - {booking_end} Uhr",
                    "advice_library_card": "Bitte bringen Sie Ihren Bibliotheksausweis mit (für TU-Studierende gilt der Studierendenausweis als Bibliotheksausweis). Diesen benötigen Sie für den Check-in und Check-out. Ein Einlass ohne Bibliotheksausweis ist nicht möglich.",
                    "usage_notes_general_hl": "Bitte beachten Sie die folgenden Hinweise zur Nutzung von Arbeitsplätzen",
                    "usage_notes_general": {
                        "usage_notes_general_1": "Eine Arbeitsplatznutzung ist nur nach vorheriger Anmeldung im Buchungssystem möglich.",
                        "usage_notes_general_2": "Vor Ort erfolgt über das Ein- und Auschecken eine Anwesenheitsdokumentation nach §3 <a href=\"https://www.berlin.de/corona/massnahmen/verordnung/\" target=\"_blank\">SARS-CoV-2-Infektionsschutzverordnung</a>.",
                        "usage_notes_general_3": "Bitte bringen Sie Arbeitsmaterialien wie Laptop, Stifte und Papier mit.",
                        "usage_notes_general_4": "Für den Einlass ins Gebäude ist das Vorzeigen Ihres Bibliotheksausweises (bei TU-Studierenden der Studierendenausweis) erforderlich.",
                        "usage_notes_general_5": "Aufgrund der Regulierung des Zutritts zum Gebäude kann es zu Wartezeiten kommen. Bitte planen Sie dies ein.",
                        "usage_notes_general_6": "Das Tragen eines Mund-Nasen-Schutz ist verpflichtend, soweit sie sich nicht auf ihrem Sitzplatz aufhalten.",
                        "usage_notes_general_7": "Ihre Reservierung gilt jeweils für den gesamten gebuchten Zeitraum. Sie verfällt nicht automatisch, wenn Sie sich erst im Laufe des Tages oder gar nicht einchecken. Stornieren Sie daher bitte Ihre Buchung, falls Sie den Termin nicht wahrnehmen können."
                    },
                    "usage_notes_in_practice_hl": "Vor Ort",
                    "usage_notes_in_practice": {
                        "zb": {
                            "usage_notes_in_practice_1": "Nach dem Betreten des Gebäudes loggen Sie sich am Check-in-Schalter mit Ihrem Bibliotheksausweis (bei TU-Studierenden der Studierendenausweis) ein.",
                            "usage_notes_in_practice_2": "Bitte nehmen Sie sich einen Korb in der zugewiesenen Etagenfarbe und begeben sich auf direktem Weg zu der Etage, auf der Ihr Sitzplatz gebucht ist. Auf der gebuchten Etage haben Sie freie Sitzplatzwahl.",
                            "usage_notes_in_practice_3": "Wenn Sie sich im Gebäude bewegen oder eine Pause machen, führen Sie Ihren Korb bitte immer mit sich.",
                            "usage_notes_in_practice_4": "Ihren Arbeitsplatz reinigen Sie vor und nach der Benutzung mit den bereitgestellten Reinigungsmaterialien.",
                            "usage_notes_in_practice_5": "Bitte achten Sie darauf, ausreichend Sicherheitsabstand zu anderen Personen zu halten.",
                            "usage_notes_in_practice_6": "Sanitäranlagen stehen nur zur Einzelnutzung zur Verfügung. Desinfektionsmöglichkeiten werden bereitgestellt.",
                            "usage_notes_in_practice_7": "Beim Verlassen des Gebäudes loggen Sie sich am Check-out-Schalter mit Ihrem Bibliotheksausweis aus und stellen den Korb zurück."
                        },
                        "mathe": {
                            "usage_notes_in_practice_1": "Nach dem Betreten des Mathematik-Gebäudes zeigen Sie bitte die Buchungsbestätigung ausgedruckt oder auf Ihrem Smartphone an der Pförtnerloge vor.",
                            "usage_notes_in_practice_2": "Nach Prüfung durch das Aufsichtspersonal begeben Sie sich bitte auf direktem Wege in die 1. Etage zur Bibliothek (Raum MA 163).",
                            "usage_notes_in_practice_3": "Sie werden dort vom Bibliotheksteam empfangen und eingecheckt."
                        },
                        "dbwm": {
                            "usage_notes_in_practice_1": "Zum Betreten des Hauptgebäudes zeigen Sie bitte die Buchungsbestätigung ausgedruckt oder auf Ihrem Smartphone an der Pförtnerloge vor.",
                            "usage_notes_in_practice_2": "Nach Prüfung durch das Aufsichtspersonal begeben Sie sich bitte auf direktem Wege in die 5. Etage zur Bibliothek.",
                            "usage_notes_in_practice_3": "Bitte beachten Sie, dass die Fahrstühle nur einzeln genutzt werden können und dass im gesamten Hauptgebäude Maskenpflicht besteht. Sonstige Aufenthalte z.B. Pausen sind im Hauptgebäude nicht gestattet.",
                            "usage_notes_in_practice_4": "Sie werden vor Ort in der Bibliothek vom Bibliotheksteam empfangen und eingecheckt.",
                            "usage_notes_in_practice_5": "Wenn Sie eine Pause machen und die Bibliothek sowie das Hauptgebäude verlassen, führen Sie Ihren Korb oder den farbigen Einleger bitte immer mit sich. Ihr Platz bleibt reserviert - lassen Sie Pausenkarte und ggf. Korb an dem von Ihnen genutzten Arbeitsplatz stehen.",
                            "usage_notes_in_practice_6": "Wenn Ihr Bibliotheksaufenthalt für den Tag beendet ist, wenden Sie sich an das Bibliotheksteam zum Auschecken und geben Ihren Korb zurück. Ihr Platz wird wieder frei.",
                            "usage_notes_in_practice_7": "Bitte verlassen Sie auf direktem Weg die Bibliothek und das Hauptgebäude."
                        },
                        "bbphysik": {
                            "usage_notes_in_practice_1": "Betreten Sie das Gebäude durch den Haupteingang und zeigen Sie an der Pförtnerloge dieses Bestätigungsschreiben (digital oder ausgedruckt) und Ihren Bibliotheksausweis (für TU-Studierende gilt der Studierendenausweis als Bibliotheksausweis) vor, damit Sie Einlass erhalten.",
                            "usage_notes_in_practice_2": "<a href=\"https://www.ub.tu-berlin.de/bibliothek-benutzen/standorte-und-oeffnungszeiten/wegbeschreibung-zur-bb-physik/\">So kommen Sie am besten zur Bereichsbibliothek</a>",
                            "usage_notes_in_practice_3": "In der Bibliothek nehmen Sie sich bitte einen Korb und reinigen ihn mit den bereitgestellten Reinigungsmaterialien.",
                            "usage_notes_in_practice_4": "Kommen Sie mit Ihrem Bibliotheksausweis zur Ausleihtheke und lassen Sie sich einchecken.",
                            "usage_notes_in_practice_5": "Sie haben freie Platzwahl.",
                            "usage_notes_in_practice_6": "Ihren Arbeitsplatz reinigen Sie vor und nach der Benutzung mit den bereitgestellten Reinigungsmaterialien.",
                            "usage_notes_in_practice_7": "Bitte achten Sie darauf, ausreichend Sicherheitsabstand zu anderen Personen zu halten.",
                            "usage_notes_in_practice_8": "Sanitäranlagen stehen auf der Etage außerhalb der Bibliothek zur Verfügung.",
                            "usage_notes_in_practice_9": "Desinfektionsmittel werden bereitgestellt.",
                            "usage_notes_in_practice_10": "Führen Sie Ihren Korb stets mit sich, auch wenn Sie eine Pause machen und die Bibliothek verlassen.",
                            "usage_notes_in_practice_11": "Beim endgültigen Verlassen der Bibliothek kommen Sie bitte an die Ausleihtheke mit ihrem Bibliotheksausweis zum Check-out und stellen Sie Ihren Korb zurück."
                        },
                        "bbarch": {
                            "usage_notes_in_practice_1": "Betreten Sie das Gebäude durch den Haupteingang (Gebäude A, Hochhaus) und zeigen Sie an der Pförtnerloge dieses Bestätigungsschreiben (digital oder ausgedruckt) und Ihren Bibliotheksausweis (für TU-Studierende gilt der Studierendenausweis als Bibliotheksausweis) vor, damit Sie Einlass erhalten.",
                            "usage_notes_in_practice_2": "In der Bibliothek nehmen Sie sich bitte einen Korb und reinigen ihn mit den bereitgestellten Reinigungsmaterialien.",
                            "usage_notes_in_practice_3": "Kommen Sie mit Ihrem Bibliotheksausweis zur Ausleihtheke und lassen Sie sich einchecken.",
                            "usage_notes_in_practice_4": "Sie haben freie Platzwahl.",
                            "usage_notes_in_practice_5": "Ihren Arbeitsplatz reinigen Sie vor und nach der Benutzung mit den bereitgestellten Reinigungsmaterialien.",
                            "usage_notes_in_practice_6": "Bitte achten Sie darauf, ausreichend Sicherheitsabstand zu anderen Personen zu halten.",
                            "usage_notes_in_practice_7": "Sanitäranlagen stehen auf der Etage außerhalb der Bibliothek zur Verfügung.",
                            "usage_notes_in_practice_8": "Desinfektionsmittel werden bereitgestellt.",
                            "usage_notes_in_practice_9": "Führen Sie Ihren Korb stets mit sich, auch wenn Sie eine Pause machen und die Bibliothek verlassen.",
                            "usage_notes_in_practice_10": "Beim endgültigen Verlassen der Bibliothek kommen Sie bitte an die Ausleihtheke mit ihrem Bibliotheksausweis zum Check-out und stellen Sie Ihren Korb zurück."
                        }
                    }
                },
                "daily_stats": {
                    "subject": "Tagesstatistik Buchungssystem {location} {date}",
                    "goodbye": "Bis morgen!",
                    "bookings": "Buchungen",
                    "check_ins": "Check-Ins",
                    "check_outs": "Check-Outs",
                    "bookings_with_check_in": "Buchungen mit Check-In",
                    "check_ins_with_check_out": "Check-Ins mit Check-Out",
                    "total_users": "Anzahl Gesamtkunden im System",
                    "total_logins": "Anzahl Logins im System"
                }
            },
            "checkin": {
                "title": "Check-In",
                "text_1": "Bitte scannen Sie Ihren Bibliotheksausweis ein.",
                "text_2": "Mit dem Einscannen des Bibliotheksausweises bestätigen Sie, dass Sie sich gesund fühlen. Wenn Sie Erkältungssymptome haben (z.B. Fieber oder Husten), dürfen Sie die Universitätsbibliothek nicht betreten.",
                "form": {
                    "checkin": {
                        "barcode": {
                            "placeholder": "1690 ..."
                        }
                    }
                },
                "status": {
                    "checkin_success": {
                        "title": "Check-In erfolgreich",
                        "text": "Bitte nehmen Sie einen <span style=\"color: {resource_color}\">Korb</span> und gehen direkt zu {resource_name}."
                    },
                    "checkin_failure": {
                        "title": "Check-In nicht erfolgreich",
                        "text_active_checkin_present": "Sie sind bereits eingecheckt.",
                        "text_no_booking_present": "Keine Reservierung vorhanden. Bitte buchen Sie online einen Arbeitsplatz."
                    }
                }
            },
            "checkout": {
                "title": "Check-Out",
                "text_1": "Bitte scannen Sie Ihren Bibliotheksausweis ein.",
                "form": {
                    "checkout": {
                        "barcode": {
                            "placeholder": "1690 ..."
                        }
                    }
                },
                "status": {
                    "checkout_success": {
                        "title": "Auf Wiedersehen",
                        "text": "Bitte stellen Sie Ihren Korb zurück."
                    },
                    "checkout_failure": {
                        "title": "Checkout nicht möglich",
                        "text": "Bitte sprechen Sie das UB-Personal an."
                    }
                }
            },
            "admin": {
                "title": "Administration Buchungssystem für Arbeitsplätze",
                "intro": "Hier können Einstellungen vorgenommen werden.",
                "locations": {
                    "title": "Standorte",
                    "description": "Hier können Standorte, Ressourcen, Zeitslots und Schließzeiten verwaltet werden.",
                    "label": {
                        "uid": "UID",
                        "name": "Name",
                        "address": "Adresse",
                        "email": "E-Mail",
                        "logo": "Logo",
                        "image": "Teaser",
                        "coordinates": "Koordinaten",
                        "days_in_advance": "Tage",
                        "user_booking_quota": "Buchungslimit",
                        "actions": "Aktionen"
                    },
                    "form": {
                        "new": {
                            "title": "Neuen Standort eintragen"
                        },
                        "edit": {
                            "title": "Standorte ändern"
                        },
                        "delete": {
                            "message": "Wirklich löschen?"
                        },
                        "fields": {
                            "uid": {
                                "label": "UID"
                            },
                            "name": {
                                "label": "Name"
                            },
                            "address": {
                                "label": "Adresse"
                            },
                            "email": {
                                "label": "E-Mail"
                            },
                            "logo_uri": {
                                "label": "Logo URI"
                            },
                            "image_uri": {
                                "label": "Teaserbild URI"
                            },
                            "latitude": {
                                "label": "Breitengrad"
                            },
                            "longitude": {
                                "label": "Längengrad"
                            },
                            "display_days_in_advance": {
                                "label": "Buchbare Tage im Voraus"
                            },
                            "user_booking_quota": {
                                "label": "Buchungslimit je User"
                            }
                        },
                        "submit_value": "Speichern",
                        "submit_progress_value": "Speichere ...",
                        "cancel_value": "Abbrechen",
                        "cancel_message": "Wirklich abbrechen?"
                    },
                    "action": {
                        "new": "Neu",
                        "edit": "Ändern",
                        "delete": "Löschen",
                        "resources": "Ressourcen",
                        "closings": "Schließzeiten",
                        "admin_index": "Admin-Übersicht"
                    }
                },
                "resources": {
                    "title": "Ressourcen",
                    "description": "Hier können Standorte, Ressourcen, Zeitslots und Schließzeiten verwaltet werden.",
                    "label": {
                        "name": "Name",
                        "short_name": "Kurzname",
                        "location": "Standort",
                        "capacity": "Kapazität",
                        "time_slots": "Slots",
                        "actions": "Aktionen"
                    },
                    "form": {
                        "new": {
                            "title": "Neue Ressource eintragen"
                        },
                        "edit": {
                            "title": "Ressource ändern"
                        },
                        "delete": {
                            "message": "Wirklich löschen?"
                        },
                        "fields": {
                            "name": {
                                "label": "Name"
                            },
                            "short_name": {
                                "label": "Kurzname"
                            },
                            "location": {
                                "label": "Standort"
                            },
                            "capacity": {
                                "label": "Kapazität"
                            },
                            "color": {
                                "label": "Farbe"
                            },
                            "text_color": {
                                "label": "Dazu passende Textfarbe"
                            }
                        },
                        "submit_value": "Speichern",
                        "submit_progress_value": "Speichere ...",
                        "cancel_value": "Abbrechen",
                        "cancel_message": "Wirklich abbrechen?"
                    },
                    "action": {
                        "new": "Neu",
                        "edit": "Ändern",
                        "delete": "Löschen",
                        "location_index": "Standorte",
                        "time_slot_index": "Slots"
                    }
                },
                "time_slots": {
                    "title": "Slots",
                    "description": "Hier können Standorte, Ressourcen, Zeitslots und Schließzeiten verwaltet werden.",
                    "label": {
                        "week_day": "Wochentag",
                        "start": "Beginn",
                        "end": "Ende",
                        "date_start": "Von",
                        "date_end": "Bis",
                        "actions": "Aktionen"
                    },
                    "form": {
                        "new": {
                            "title": "Neuen Slot anlegen"
                        },
                        "edit": {
                            "title": "Slot ändern"
                        },
                        "delete": {
                            "message": "Wirklich löschen?"
                        },
                        "fields": {
                            "week_day": {
                                "label": "Wochentag"
                            },
                            "start": {
                                "label": "Startzeit"
                            },
                            "end": {
                                "label": "Endzeit"
                            },
                            "date_from": {
                                "label": "Gültig ab (optional)"
                            },
                            "date_to": {
                                "label": "Gültig bis (optional)"
                            }
                        },
                        "submit_value": "Speichern",
                        "submit_progress_value": "Speichere ...",
                        "cancel_value": "Abbrechen",
                        "cancel_message": "Wirklich abbrechen?"
                    },
                    "action": {
                        "new": "Neu",
                        "edit": "Ändern",
                        "delete": "Löschen",
                        "resource_index": "Ressourcen"
                    }
                },
                "bookings": {
                    "title": "Buchungen",
                    "description": "Hier können durch Eingabe eines Barcodes die Buchungen einer Person geprüft werden.",
                    "form": {
                        "index": {
                            "barcode": {
                                "label": "Barcode",
                                "placeholder": "Barcode"
                            },
                            "submit_value": "Buchungen suchen",
                            "submit_progress_value": "Suche Buchungen ..."
                        }
                    },
                    "label": {
                        "date": "Datum",
                        "location": "Standort",
                        "resource": "Ort",
                        "start": "Beginn",
                        "end": "Ende",
                        "status_active": "Aktiv",
                        "status_deleted_by_user": "Userlöschung",
                        "status_check_in": "Check-In",
                        "status_check_out": "Check-Out"
                    },
                    "status": {
                        "active": "Aktiv",
                        "expired": "Abgelaufen",
                        "deleted_by_user": "Manuelle Löschung am {date} um {time} Uhr",
                        "checked_in": "Check-In vorhanden",
                        "not_checked_in": "kein Check-In vorhanden",
                        "checked_out": "Check-Out vorhanden"
                    }
                },
                "closings": {
                    "title": "Schließzeiten",
                    "description": "Hier können Schließzeiten für Standorte eingetragen werden.",
                    "form": {
                        "new": {
                            "title": "Neue Schließzeit eintragen"
                        },
                        "edit": {
                            "title": "Schließzeit ändern"
                        },
                        "delete": {
                            "message": "Wirklich löschen?"
                        },
                        "fields": {
                            "date_start": {
                                "label": "Von"
                            },
                            "date_end": {
                                "label": "Bis (optional)"
                            },
                            "description": {
                                "label": "Beschreibung"
                            }
                        },
                        "submit_value": "Speichern",
                        "submit_progress_value": "Speichere ...",
                        "cancel_value": "Abbrechen",
                        "cancel_message": "Wirklich abbrechen?"
                    },
                    "label": {
                        "date_start": "Von",
                        "date_end": "Bis",
                        "description": "Beschreibung",
                        "actions": "Aktionen"
                    },
                    "action": {
                        "new": "Neu",
                        "edit": "Ändern",
                        "delete": "Löschen",
                        "location_index": "Standortübersicht"
                    },
                    "status": []
                }
            }
        }
    },
    "en": {
        "app": {
            "main": {
                "title": "Booking System for Library Study Places",
                "owner": "Universitätsbibliotheken der TU Berlin und UdK Berlin",
                "user": {
                    "login_as": "Logged in as",
                    "phone": "Phone number",
                    "number_of_bookings": "Number of bookings"
                }
            },
            "home": {
                "title": "Welcome!",
                "intro": ""
            },
            "time_grid": {
                "intro": "You can reserve up to 5 dates during the next 14 days",
                "legend": "Legend",
                "pagination": {
                    "previous": "Previous",
                    "now": "Now",
                    "next": "Next"
                },
                "form": {
                    "create": {
                        "title": "Are You Sure?",
                        "text": "You are now creating a reservation.",
                        "submit_value": "Create a reservation.",
                        "cancel_value": "Cancel"
                    }
                },
                "status": {
                    "create_success": {
                        "text": "Your reservation was successful. A confirmation email was sent to {email}"
                    },
                    "create_failure": {
                        "text_time_slot_is_over": "This time slot is already over.",
                        "text_time_slot_already_booked": "This time slot is already booked by you.",
                        "text_quota_exhausted": "You have reached the limit of {user_booking_quota} and can therefore not create new bookings"
                    }
                }
            },
            "bookings": {
                "title": "Your Reservations",
                "intro": "",
                "action": {
                    "resend": "Resend confirmation",
                    "delete": "Delete"
                },
                "form": {
                    "delete": {
                        "title": "Are you sure?",
                        "text": "You are about to delete a reservation.",
                        "submit_value": "Delete reservation",
                        "cancel_value": "Cancel"
                    }
                },
                "status": {
                    "in_progress": "Reservation is already in progress",
                    "no_bookings": "There are no reservations.",
                    "delete_success": "Reservation has been deleted successfully.",
                    "resend_success": "Confirmation has been sent successfully."
                }
            },
            "profile": {
                "title": "My Profile",
                "intro": "",
                "label": {
                    "username": "ID",
                    "phone": "Your phone Number"
                },
                "action": {
                    "edit_phone": "Edit"
                }
            },
            "login": {
                "title": "Login",
                "intro": "",
                "form": {
                    "login": {
                        "username": {
                            "label": "Your login",
                            "placeholder": ""
                        },
                        "password": {
                            "label": "Your password",
                            "placeholder": "Your password"
                        },
                        "submit_value": "Login",
                        "submit_progress_value": "Authenticating ..."
                    }
                },
                "status": {
                    "login_success": "Login was successful.",
                    "login_failure": "Login was not successful."
                }
            },
            "logout": {
                "title": "Logout",
                "status": {
                    "logout_success": "Logout was successful.",
                    "logout_failure": "Logout was not successful."
                }
            },
            "auth": {
                "status": {
                    "auth_failure": "An authentication error has occurred."
                }
            },
            "phone": {
                "form": {
                    "create": {
                        "title": "Please Enter Your Phone Number",
                        "text": "We require this for attendance documentation according to §3 <a class=\"underline cursor-pointer\" href=\"https://www.berlin.de/corona/en/measures/directive/\" target=\"_blank\">SARS-CoV-2 infection protection regulation</a>. It is automatically deleted after four weeks.",
                        "submit_value": "Add phone number",
                        "cancel_value": "Cancel"
                    },
                    "edit": {
                        "title": "Please Enter Your Phone Number",
                        "text": "We require this for attendance documentation according to §3 <a class=\"underline cursor-pointer\" href=\"https://www.berlin.de/corona/en/measures/directive/\" target=\"_blank\">SARS-CoV-2 infection protection regulation</a>. It is automatically deleted after four weeks.",
                        "submit_value": "Change phone number",
                        "cancel_value": "Cancel"
                    }
                },
                "status": {
                    "create_success": "Phone number was successfully registered.",
                    "create_failure": "Phone number could not be registered.",
                    "edit_success": "Phone number was successfully changed.",
                    "edit_failure": "Phone number could not be changed."
                }
            },
            "mail": {
                "subject": "Date confirmation",
                "title": "Date Confirmation",
                "hello": "",
                "goodbye": "Thank you!",
                "intro": "We hereby confirm your date for study place use.",
                "address": "Address",
                "resource": "Location",
                "user_barcode": "Library card number",
                "date": "Date",
                "time": "Time",
                "time_value": "{booking_start} - {booking_end} ",
                "advice_library_card": "Please bring your library card with you (for TU students the student card is valid as library card). You will need it for check-in and check-out. Admission without library card is not possible.",
                "usage_notes_general_hl": "Please note the following notes on the use of study places",
                "usage_notes_general": {
                    "usage_notes_general_1": "Use of a library study place is only possible after prior registration in the booking system.",
                    "usage_notes_general_2": "Reservation dates are available for the following periods: Monday to Friday from 10{00} to 16{00}.",
                    "usage_notes_general_3": "On site an attendance documentation according to §3 <a href=\"https://www.berlin.de/corona/en/measures/directive/\" target=\"_blank\">SARS-CoV-2 infection protection regulation</a> is carried out by checking in and out.",
                    "usage_notes_general_4": "Please bring your own equipment and materials like laptop, pens and paper.",
                    "usage_notes_general_5": "To enter the building you need to show your library card (for TU students the student card).",
                    "usage_notes_general_6": "Due to the regulation of access to the building, waiting times may occur. Please plan for this.",
                    "usage_notes_general_7": "The wearing of a mouth-nose cover is obligatory when you are not sitting at your study place."
                },
                "usage_notes_in_practice_hl": "On site",
                "usage_notes_in_practice": {
                    "usage_notes_in_practice_1": "After entering the building you log in at the check-in counter with your library card (for TU students the student card).",
                    "usage_notes_in_practice_2": "Please take a basket in the assigned floor colour and proceed directly to the floor on which your seat is booked. You have free choice of seating on the floor you have booked.",
                    "usage_notes_in_practice_3": "If you move around the building or take a break, please always carry your basket with you.",
                    "usage_notes_in_practice_4": "Please clean your study place before and after use with the cleaning materials provided.",
                    "usage_notes_in_practice_5": "Please make sure to observe a sufficient physical distance (at least 2 metres) to others.",
                    "usage_notes_in_practice_6": "Sanitary facilities may be only used by one person at a time. Disinfectants are provided.",
                    "usage_notes_in_practice_7": "When you leave the building, log out at the check-out counter with your library card and return the basket back."
                }
            },
            "checkin": {
                "title": "Check-In",
                "text_1": "Please scan you library card.",
                "text_2": "By scanning your library card you confirm that you are healthy. If you have symptoms of a cold (e.g. fever or cough), you are not allowed to enter the University Library.",
                "form": {
                    "checkin": {
                        "barcode": {
                            "placeholder": "1690 ..."
                        }
                    }
                },
                "status": {
                    "checkin_success": {
                        "title": "Check-In Successful",
                        "text": "Please take a basket <span style=\"color: {resource_color}\">Korb</span> and go directly to {resource_name}."
                    },
                    "checkin_failure": {
                        "title": "Check-In Not Successful",
                        "text_active_checkin_present": "You are checked in already.",
                        "text_no_booking_present": "No reservation present. Please book a study place online."
                    }
                }
            },
            "checkout": {
                "title": "Check-Out",
                "text_1": "Please scan your library card.",
                "form": {
                    "checkout": {
                        "barcode": {
                            "placeholder": "1690 ..."
                        }
                    }
                },
                "status": {
                    "checkout_success": {
                        "title": "Good Bye",
                        "text": "Please return your basket."
                    },
                    "checkout_failure": {
                        "title": "Check-Out not possible",
                        "text": "Please contact the library staff."
                    }
                }
            }
        }
    }
}
