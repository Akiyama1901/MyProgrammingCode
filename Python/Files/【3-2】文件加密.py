with open("latex.log","r") as f,open("new_file.txt","w") as nf:
    file = f.read()
    finished_file = ""
    for char in file:
        if "A"<=char<="Z":
            processed_char = chr((ord(char) - ord('A') + 1) % 26 + ord('A'))
        elif "a"<=char<="z":
            processed_char = chr((ord(char) - ord('a') + 1) % 26 + ord('a'))
        else:
            processed_char = char
        finished_file += processed_char
    nf.write(finished_file)
    print("完成")