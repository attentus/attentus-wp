import subprocess

env_path = '../.env'

if os.path.exists(env_path):
    return True
else:
    shutil.copy(
        '../.env.example',
        env_path
    )

    return True

try:
	subprocess.check_output(['wp', 'core', 'version'])
except FileNotFoundError:
	exit('ERROR: WP-CLI was not found.')

subprocess.run(['wp', 'plugin', 'activate', '--all'])

subprocess.run(['wp', 'language', 'core', 'install', 'de_DE', '--activate'])

subprocess.run(['wp', 'option', 'set', 'timezone_string', 'Europe/Berlin'])

subprocess.run(['wp', 'option', 'set', 'date_format', 'j. F Y'])

subprocess.run(['wp', 'option', 'set', 'time_format', 'H:i'])

subprocess.run(['wp', 'option', 'set', 'date_format', 'uploads_use_yearmonth_folders', '0'])

subprocess.run(['wp', 'option', 'set', 'permalink_structure', '/%postname%/'])

subprocess.run(['wp', 'theme', 'activate', 'attentus'])
