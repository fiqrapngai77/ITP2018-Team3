from cx_Freeze import setup, Executable

base = None    

executables = [Executable("helloworld.py", base=base)]

packages = ["idna"]
options = {
    'build_exe': {    
        'packages':packages,
    },    
}

setup(
    name = "objectDectector",
    options = options,
    version = "1",
    description = 'helloWorld',
    executables = executables
)
