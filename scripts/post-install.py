import os
import shutil
import distutils
import sys
import subprocess
import functions

subprocess.run(
	[
		'wp',
		'plugin',
		'activate',
		'--all'
	]
)

subprocess.run(
	[
		'wp',
		'language',
		'core',
		'install',
		'de_DE_formal',
		'--activate'
	]
)

subprocess.run(
	[
		'wp',
		'option',
		'set',
		'timezone_string',
		'Europe/Berlin'
	]
)

subprocess.run(
	[
		'wp',
		'option',
		'set',
		'date_format',
		'j. F Y'
	]
)

subprocess.run(
	[
		'wp',
		'option',
		'set',
		'time_format',
		'H:i'
	]
)

subprocess.run(
    [
        'wp',
        'option',
        'update',
        'uploads_use_yearmonth_folders',
        '0'
    ]
)

subprocess.run(
    [
        'wp',
        'option',
        'update',
        'permalink_structure',
        '/%postname%/'
    ]
)

subprocess.run(
    [
        'wp',
        'theme',
        'activate',
        'attentus'
    ]
)