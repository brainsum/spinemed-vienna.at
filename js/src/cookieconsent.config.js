window.CookieConsent.init({
    barTimeout: 1000,
    theme: {
        barColor: '#3fa3bf',
        barTextColor: 'white',
        barMainButtonColor: 'white',
        barMainButtonTextColor: '#3fa3bf',
        modalMainButtonColor: '#49c2d8',
        modalMainButtonTextColor: 'white',
    },
    language: {
        current: 'de',
        locale: {
            de: {
                barMainText: 'Diese Website verwendet Cookies – nähere Informationen dazu und zu Ihren Rechten als Benutzer finden Sie in unserer Datenschutzerklärung am Ende der Seite. Klicken Sie auf „Akzeptiere alle Cookies“, um Cookies zu akzeptieren und direkt unsere Website besuchen zu können.',
                barLinkSetting: 'Cookie-Einstellungen',
                barBtnAcceptAll: 'Akzeptiere alle Cookies',
                modalMainTitle: 'Cookie settings',
                modalMainText: 'Cookies sind kleine Daten, die von einer Website gesendet und vom Webbrowser des Benutzers auf dem Computer des Benutzers gespeichert werden, während der Benutzer surft. Ihr Browser speichert jede Nachricht in einer kleinen Datei, die als Cookie bezeichnet wird. Wenn Sie eine andere Seite vom Server anfordern, sendet Ihr Browser das Cookie zurück an den Server. Cookies wurden als zuverlässiger Mechanismus für Websites entwickelt, um Informationen zu speichern oder die Surfaktivität des Benutzers aufzuzeichnen.',
                modalBtnSave: 'Aktuelle Einstellungen speichern',
                modalBtnAcceptAll: 'Alle Cookies akzeptieren und schließen',
                modalAffectedSolutions: 'Betroffene Lösungen:',
                learnMore: 'Mehr erfahren',
                on: 'On',
                off: 'Off',
            }
        }
    },
    categories: {
        necessary: {
            needed: true,
            wanted: true,
            checked: true,
            language: {
                locale: {
                    de: {
                        name: 'Unbedingt notwendige Cookies',
                        description: 'Unbedingt notwendige Cookies sind kleine Daten, die von einer Website gesendet und vom Webbrowser des Benutzers auf dem Computer des Benutzers gespeichert werden, während der Benutzer surft. Cookies wurden als zuverlässiger Mechanismus für Websites entwickelt, um Informationen zu speichern oder die Surfaktivität des Benutzers aufzuzeichnen.',
                    }
                }
            }
        },
    },
    services: {
        analytics: {
            category: 'necessary',
            type: 'dynamic-script',
            search: 'analytics',
            language: {
                locale: {
                    de: {
                        name: 'Google Analytics'
                    }
                }
            }
        }
    }
});