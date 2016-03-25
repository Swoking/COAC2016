#include "listclasse.h"
#include <QStandardItemModel>
#include <QSqlQuery>
#include "database.h"

ListClasse::ListClasse(COAC *parentFenetre, Database *database) :
    MyList(parentFenetre, database)
{
    this->setWindowTitle("liste des classes");
    showList();
}

void ListClasse::showList(){

    if(db->getDB().isOpen()){

        QSqlQuery queryPromos;
        queryPromos.prepare("SELECT * FROM Promo;");
        queryPromos.exec();

        QStandardItemModel *model = new QStandardItemModel();
        while (queryPromos.next()) {
            qDebug() << "ListClasse::showList() > ajout d'une classe.";
            QStandardItem *itemClasse = new QStandardItem();
            itemClasse->setText( queryPromos.value(3).toString() );
            itemClasse->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
            model->appendRow(itemClasse);
        }
        myTreeList->setModel(model);
    }

}
