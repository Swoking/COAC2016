#-------------------------------------------------
#
# Project created by QtCreator 2016-04-07T19:20:37
#
#-------------------------------------------------

QT       += core gui
QT       += sql multimedia multimediawidgets
QT       += webkitwidgets
QT       += network
QT += printsupport

QTPLUGIN += qsqlmysql

greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = COAC2016
TEMPLATE = app

UI_DIR			= .uic
RCC_DIR			= .uic
MOC_DIR			= .moc
OBJECTS_DIR		= .obj

SOURCES += main.cpp\
        coac.cpp \
    database.cpp \
    camera.cpp \
    listeleve.cpp \
    listclasse.cpp \
    listsalle.cpp \
    listcarte.cpp \
    listlog.cpp \
    mylist.cpp \
    myadd.cpp \
    addcarte.cpp \
    addclasse.cpp \
    addsalle.cpp \
    addlycee.cpp

HEADERS  += coac.h \
    database.h \
    camera.h \
    overlay.h \
    listeleve.h \
    listclasse.h \
    listsalle.h \
    listcarte.h \
    listlog.h \
    mylist.h \
    myadd.h \
    addcarte.h \
    addclasse.h \
    addsalle.h \
    addlycee.h

FORMS    += coac.ui \
    mylist.ui \
    myadd.ui
