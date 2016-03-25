#include "coac.h"
#include "database.h"
#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);

    COAC w( new Database );
    w.show();

    return a.exec();
}


// sudo apt-get install libqt5webkit5-dev
