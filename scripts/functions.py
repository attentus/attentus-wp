import os
import shutil


def copy_env_file():
	env_path = '../.env'

	if os.path.exists(env_path):
		return True
	else:
		shutil.copy(
			'../.env.example',
			env_path
		)

		return True
