import subprocess

subprocess.run(['wp', 'transient', 'delete', '--all'])
subprocess.run(['wp', 'rewrite', 'flush'])
