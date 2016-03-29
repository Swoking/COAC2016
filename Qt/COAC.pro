#-------------------------------------------------
#
# Project created by QtCreator 2016-03-08T09:10:28
#
#-------------------------------------------------

QT       += core gui
QT       += sql multimedia multimediawidgets

QTPLUGIN += qsqlmysql

greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = COAC
TEMPLATE = app

UI_DIR			= .uic
RCC_DIR			= .uic
MOC_DIR			= .moc
OBJECTS_DIR		= .obj

SOURCES += main.cpp \
    coac.cpp \
    database.cpp \
    camera.cpp \
    elevelist.cpp \
    addclass.cpp \
    addcarte.cpp

HEADERS  += \
    coac.h \
    database.h \
    camera.h \
    elevelist.h \
    addclass.h \
    addcarte.h

FORMS    += coac.ui \
            elevelist.ui \
    addclass.ui \
    addcarte.ui

RESOURCES += \
    ressource.qrc
