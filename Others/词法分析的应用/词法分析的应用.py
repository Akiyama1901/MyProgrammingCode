import jieba
import jieba.analyse

# 简单分词模式
text = "中华人民共和国是伟大的"
words = []
for word in jieba.cut(text):
    words.append(word)
print(words)
print()

# 实验（一）Python语言中jieba三种分词模式的基本使用
# 精确模式
word1 = jieba.cut(text, cut_all=False)
words = []
for word in word1:
    words.append(word)
print("精确模式分词效果:", words)

# 全模式
word2 = jieba.cut(text,cut_all=True)
words = []
for word in word2:
    words.append(word)
print("全模式分词效果:",words)

# 全搜索引擎分词效果
word3 = jieba.cut_for_search(text)
words = []
for word in word3:
    words.append(word)
print("全模式分词效果:",words)

print()

# 实验（二）输出词性标注
print("词性标注结果如下：")
words = jieba.posseg.cut(text)
for word,flag in words:
    print(f"{word}->{flag}")

print()

print("                             附加实验")

# 添加自定义词典
text = "我喜欢编译原理和算法设计与分析"
word4 = jieba.cut(text)
words = []
for word in word4:
    words.append(word)
print("未使用自定义词典前:",words)

jieba.add_word("编译原理")
jieba.add_word("算法设计与分析")
word4 = jieba.cut(text)
words = []
for word in word4:
    words.append(word)
print("使用自定义词典:",words)

print()

# 关键词提取
text = "Python是一个高层次的结合了解释性、编译性、互动性和面向对象的脚本语言。"
keywords = jieba.analyse.extract_tags(text,topK=3)
print("关键词提取:",keywords)

print()

# 实验（三）基于TF-IDF(词频-逆文件频率)的带权重关键词提取
# 参考
print("示例情况：")
jieba.analyse.set_idf_path("idf.txt")
sentence = "算法是对特定问题求解步骤的描述，是指令的有限序列。就是定义良好的计算过程，" \
           "他取一个或一组的值为输入，并产生出一个或一组值作为输出。简单来说算法就是一系列的计算步骤，用来将输入数据转化成输出结果。"
keywords = jieba.analyse.extract_tags(sentence, topK=10, withWeight=True, allowPOS=('n', 'nr', 'ns'))
for item in keywords:
    print(item)
print()

# 自定义语料库
print("自定义语料库情况：")
jieba.analyse.set_idf_path("THUOCL_it.txt")
jieba.analyse.set_stop_words("stop_words.txt")
sentence = "算法是对特定问题求解步骤的描述，是指令的有限序列。就是定义良好的计算过程，" \
           "他取一个或一组的值为输入，并产生出一个或一组值作为输出。简单来说算法就是一系列的计算步骤，用来将输入数据转化成输出结果。"
keywords = jieba.analyse.extract_tags(sentence, topK=10, withWeight=True, allowPOS=('n', 'nr', 'ns'))
for item in keywords:
    print(item)

print()

print("                             附加实验")
# 基于TF-IDF的文章的相似度检验
from gensim import corpora, models, similarities
from collections import defaultdict

def process_doc(url):
    doc = open(url, encoding='utf-8').read()
    data = jieba.cut(doc)
    return " ".join(data)

doc1 = "词法分析1.txt"
doc2 = "蛮力法.txt"
doc3 = "词法分析2.txt"
data1 = process_doc(doc1)
data2 = process_doc(doc2)

# 将两个文档的内容组成列表
documents = [data1, data2]
# 对每个文档的内容进行进一步处理，将字符串按空格分割为单词列表，形成二维列表
texts = [[word for word in document.split()] for document in documents]

# 创建一个默认值为整数0的字典，用于统计词频
frequency = defaultdict(int)
# 遍历每个文档的单词列表
for text in texts:
    for word in text:
        frequency[word] += 1

# 使用处理后的文档创建词典
dictionary = corpora.Dictionary(texts)
data3 = process_doc(doc3)

# 将第三个文档的内容转换为基于词典的词袋模型表示
input = dictionary.doc2bow(data3.split())

# 将两个文档的内容转换为词袋模型表示组成语料库
corpus = [dictionary.doc2bow(text) for text in texts]

# 使用语料库创建TF-IDF模型
tfidf = models.TfidfModel(corpus)
featurenum = len(dictionary.token2id.keys())
# 创建稀疏矩阵相似度对象，用于计算相似度
index = similarities.SparseMatrixSimilarity(tfidf[corpus], num_features=featurenum)
sim = index[tfidf[input]]
# 打印结果
print("文章三与文章一、二的相似度分别为", sim)

print()

# 实验（四）结合停用词表的关键词提取，输入某篇文章，生成词云
path = 'test1.txt'
output_path = 'result.txt'
file_in = open(path, 'r', encoding='utf-8')
content = file_in.read()
try:
    jieba.analyse.set_stop_words('stop_words.txt')
    tags = jieba.analyse.extract_tags(content, topK=100, withWeight=True)
    with open(output_path, 'w', encoding='utf-8') as output_file:
        for v, n in tags:
            print(v + '\t' + str(int(n * 10000)))
            output_line = v + '\t' + str(int(n * 10000)) + '\n'
            output_file.write(output_line)
finally:
    file_in.close()