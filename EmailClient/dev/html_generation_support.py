def createXmlTagArgList(attributes = {}):
	return ("" if len(attributes) == 0 else ' ' + ' '.join(map(lambda x,y:x+"=\""+y+"\"",attributes.keys(),attributes.values())))

def createXmlTag(tagName, attributes = {}, html_content = ""):
	return "<"+tagName+createXmlTagArgList(attributes)+">\n"+html_content+"</"+tagName+">\n"

def createMainPage(title = "", js_scripts = [], css_sheets = [], html_body = "") :
	return createXmlTag("html",{},
		createXmlTag("head",{} if len(title) == 0 else {'title':title})+
		createXmlTag("body")
	       )
