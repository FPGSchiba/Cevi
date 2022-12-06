USERNAME = 'samichlaus'
PASSWORD = '1chB1nDeSam1chlaus!?'
LOGGED_IN = False

while not LOGGED_IN:
    username = input('Benutzernamen eingeben: ')

    if username == USERNAME:
        password = input('Passwort eingeben: ')
        if password == PASSWORD:
            LOGGED_IN = True
        else:
            print(f"Passwort stimmt nicht für den Benutzer: {username}")
    else:
        print("Dieser Benutzer existiert nicht.")

print('done')
