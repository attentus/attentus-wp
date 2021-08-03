import subprocess

subprocess.run(['wp', 'flush', 'cache'])
subprocess.run(['wp', 'transient', 'delete', '--all'])
subprocess.run(['wp', 'rewrite', 'flush'])
