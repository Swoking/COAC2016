#include "elevelist.h"
#include <qdebug.h>
#include <QSqlQuery>
#include <QStandardItem>

EleveList::EleveList( COAC *fen, QWidget *parent) :
    QDialog(parent),
    fenetre(fen)
{
    setupUi(this);
    connect( treeListEleve, SIGNAL(doubleClicked(QModelIndex)), fenetre, SLOT(onDoubleClickListEleve(QModelIndex)) );
    showList();
}

void EleveList::showList() {
    Database db;
    if(db.getDB().isOpen()){

        QSqlQuery queryPromos;
        queryPromos.prepare("SELECT * FROM Promo;");
        queryPromos.exec();

        QStandardItemModel *model = new QStandardItemModel();
        while (queryPromos.next()) {
            qDebug() << "eleveList::showList > ajout d'une classe.";
            QStandardItem *itemClasse = new QStandardItem();
            itemClasse->setText( queryPromos.value(3).toString() );
            itemClasse->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
            model->appendRow(itemClasse);

            QSqlQuery queryEtudiants;
            queryEtudiants.prepare("SELECT * FROM Etudiant WHERE id_Promo = ?");
            queryEtudiants.addBindValue(queryPromos.value(0));
            queryEtudiants.exec();
             while (queryEtudiants.next()) {
                 qDebug() << "eleveList::showList > ajout d'un étudiant.";
                 QStandardItem *itemEtudiant = new QStandardItem();
                 itemEtudiant->setText(queryEtudiants.value(1).toString() + " " + queryEtudiants.value(2).toString());
                 itemEtudiant->setData(queryEtudiants.value(0).toInt());
                 itemEtudiant->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
                 itemClasse->appendRow( itemEtudiant );
             }
        }
        treeListEleve->setModel(model);
    }
}
