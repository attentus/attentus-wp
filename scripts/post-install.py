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
