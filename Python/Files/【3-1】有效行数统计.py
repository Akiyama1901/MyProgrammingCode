with open('latex.log','r') as f:
    count = 0
    space = 0
    for line in f:
        if line != '\n':
            count+=1
        else: space+=1
    print(count,space)