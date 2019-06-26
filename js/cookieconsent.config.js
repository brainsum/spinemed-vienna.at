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
                barMainText: 'This website uses cookies to ensure you get the best experience on our website.',
                barLinkSetting: 'Cookie Settings',
                barBtnAcceptAll: 'Accept all cookies',
                modalMainTitle: 'Cookie settings',
                modalMainText: 'Cookies are small piece of data sent from a website and stored on the user\'s computer by the user\'s web browser while the user is browsing. Your browser stores each message in a small file, called cookie. When you request another page from the server, your browser sends the cookie back to the server. Cookies were designed to be a reliable mechanism for websites to remember information or to record the user\'s browsing activity.',
                modalBtnSave: 'Save current settings',
                modalBtnAcceptAll: 'Accept all cookies and close',
                modalAffectedSolutions: 'Affected solutions:',
                learnMore: 'Learn More',
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
                        name: 'Strictly Necessary Cookies',
                        description: 'These are cookies that are required for the operation of our website. They include, for example, cookies that enable you to log into secure areas of our website. Statistics cookies allows us to recognise and count the number of visitors and to see how visitors move around our website when they are using it. This helps us to improve the way our website works, for example, by ensuring that users are finding what they are looking for easily.',
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