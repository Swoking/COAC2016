#include "coac.h"
#include "database.h"
#include <QApplication>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);

    COAC w;
    w.printPromos();
    w.printDateNaissance();
    w.show();

    return a.exec();
}
